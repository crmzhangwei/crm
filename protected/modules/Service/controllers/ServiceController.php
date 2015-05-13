<?php

class ServiceController extends GController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','updateNewList','assign','admin','newList','todayList',
                                                 'oldList','dial','message','mail','listen','sharedNoteList','historyNoteList',
                                                 'deptGroupArr','userArr','assignMulti'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	 

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
                $noteinfo = null;
                $model = $this->loadModel($id);
                if(isset($_POST['NoteInfo'])){
                    //保存
                    $noteinfo = new NoteInfo();
                    $noteinfo->unsetAttributes();
                    $noteinfo->attributes=$_POST['NoteInfo']; 
                    $noteinfo->next_contact=strtotime($noteinfo->next_contact);
                    $noteinfo->setAttribute("eno", Yii::app()->user->id); 
                    $noteinfo->setAttribute("create_time", time());  
                    $model->attributes=$_POST['CustomerInfo']; 
                    if($model->service){
                        $model->service['cust_type']=$_POST['CustomerInfo']['service']['cust_type'];
                    } 
                    $model->next_time=$noteinfo->next_contact;
                    if($noteinfo->dial_id<1){
                        $noteinfo->addError("dial_id", "请先拔打电话");
                    }
                    
                    if($noteinfo->dial_id>0&&$noteinfo->save()){
                        $sql = "select * from {{aftermarket_cust_info}} where cust_id=:cust_id";
                        $aftermodel = AftermarketCustInfo::model()->findBySql($sql,array(':cust_id'=>$id));
                        $aftermodel->next_time=$noteinfo->next_contact;
                        $aftermodel->cust_type=$model->service['cust_type'];
                        if($aftermodel->save()){
                            $model->service['next_time']=$aftermodel->next_time;
                        }
                        $noteinfo->next_contact=date('Y-m-d',$noteinfo->next_contact);
                    }else{
                        $noteinfo->addError("memo","请录入小记信息");
                    }  
                }else{
                    $noteinfo = new NoteInfo(); 
                    $noteinfo->setAttribute("iskey", 0);
                    $noteinfo->setAttribute("isvalid", 0);
                    $noteinfo->cust_id=$id;
                } 
                $model->setAttribute("create_time", date("Y-m-d", $model->getAttribute("create_time")));
                $model->setAttribute("assign_time", date("Y-m-d", $model->getAttribute("assign_time")));
                $model->setAttribute("next_time", date("Y-m-d", $model->getAttribute("next_time")));
                $sharedNote = NoteInfo::model();
                $sharedNote->setAttribute("cust_id", $model->id); 
                $historyNote = NoteInfo::model();
                $historyNote->setAttribute("cust_id", $model->id);
               
                if($model->contract){
                    $model->contract['create_time']= date("Y-m-d",$model->contract['create_time']);
                    $model->contract['comm_pay_time']= date("Y-m-d",$model->contract['comm_pay_time']);
                    $model->contract['pay_time']= date("Y-m-d",$model->contract['pay_time']);
                }
                if($model->service){ 
                    $model->service['assign_time']=date("Y-m-d",$model->service['assign_time']);
                    $model->service['next_time']=date("Y-m-d",$model->service['next_time']); 
                    $model->service['create_time']=date("Y-m-d",$model->service['create_time']);  
                    $user=Users::model()->findByPk($model->service['creator']);
                    $model->service['creator']=$user->getAttribute('eno');
                }  
                $user = Users::model()->findByPk(Yii::app()->user->id); 
		$this->render('update',array(
			'model'=>$model,
                        'sharedNote'=>$sharedNote,
                        'historyNote'=>$historyNote,
                        'noteinfo'=>$noteinfo,
                        'loginuser'=>$user,
		));
	}
        /**
         * 售后客户分配
         * @param type $id 客户id
         */
        public function actionAssign($id){
                $model=$this->loadModel($id);
                if(isset($_POST['CustomerInfo']))
		{
			$model->attributes=$_POST['CustomerInfo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
                
                $this->render('assign',array('model'=>$model));
        }
        /**
         * 售后客户分配-多选情况
         * @param type $id 客户id
         */
        public function actionAssignMulti(){ 
            
            if(isset($_POST['cust_id'])){
                /**
                 * 在分配页面点击保存按钮
                 * 1.更新所属工号
                 * 2.所属工号的已分配资源数+1
                 */
                $cust_ids = $_POST['cust_id'];
                if(!empty($cust_ids)){
                    $model = new AftermarketCustInfo();  
                    $model->attributes=$_POST['AftermarketCustInfo'];
                    
                    $eno = $model->eno;  
                    $enoNum = Yii::app()->db->createCommand("select cust_num from {{users}} where eno=:eno")->queryAll(TRUE,array(":eno"=>$eno));
                    $enoNum = $enoNum ? (int)$enoNum[0]['cust_num'] : 0;//该用户已分配的资源数  
                    $ids = implode(",", $cust_ids);
                    $assCount = count($cust_ids);//待分配的资源个数
                    if( ($assCount + $enoNum) > 300 ){//每个用户的分配资源数不能超过300个  
                        $model->addError("eno", "对不起, 您当前已分配了".$enoNum."个资源, 每个用户最多只能分配300个资源, 本次操作失败。");
                        $this->render("result",array(
                                         'model'=>$model,
                                    ));
                    }
                    else{
			Yii::app()->db->createCommand()->update('{{aftermarket_cust_info}}',array('eno' =>$eno),"cust_id in({$ids})");
			Yii::app()->db->createCommand()->update('{{Users}}',array('cust_num' =>new CDbExpression("cust_num+$assCount")),"eno='$eno'"); 
                        $model->addError("eno", "成功分配了".$assCount."个资源。");
                        $this->render("result",array(
                                         'model'=>$model,
                                    ));
                    } 
                }
               return ;  
            }
                if(!isset($_POST['select'])){
                    //没有选择记录的情况
                     $model=new AftermarketCustInfo('search');
                     $model->unsetAttributes();  // clear any default values 
                     $this->render('admin',array(
                            'model'=>$model,
                     ));
                     return ;
                }
                //选择了记录，跳转到分配页面
                $ids = $_POST['select'];
                $model = AftermarketCustInfo::model();
                $sql= "";
                if(is_array($ids)){
                    $sql = "select id,cust_name from {{customer_info}} where id in (".  implode(",", $ids).")";
                }else{
                    $sql="select id,cust_name from {{customer_info}} where id=".$ids;
                } 
                $list = $model->findAllBySql($sql);
                $this->render('assign',array('model'=>$model,'custlist'=>$list));
        }
         /**
	 * 搜索共享小记列表数据
	 */
	public function actionSharedNoteList()
	{
		$model=new NoteInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['NoteInfo']))
			$model->attributes=$_GET['NoteInfo'];
		if(isset($_GET['cust_id'])){
                    $custid=$_GET['cust_id'];
                    $model->setAttribute("cust_id", $custid);
                }  
                if(isset($_GET['isajax'])){
                    $this->renderPartial('_shared_note_list',array(
			'model'=>$model,
                    )); 
                }        
		
	}
         /**
	 * 搜索历史小记列表数据
	 */
	public function actionHistoryNoteList()
	{
		$model=new NoteInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['NoteInfo']))
			$model->attributes=$_GET['NoteInfo'];
		
                if(isset($_GET['cust_id'])){
                    $custid=$_GET['cust_id'];
                    $model->setAttribute("cust_id", $custid);
                } 
                if(isset($_GET['isajax'])){ 
                    
                    $this->renderPartial('_history_note_list',array(
			'model'=>$model,
                    )); 
                } 
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('CustomerInfo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * 查询分配
	 */
	public function actionAdmin()
	{
		$model=new AftermarketCustInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AftermarketCustInfo'])){
			$model->attributes=$_GET['AftermarketCustInfo'];
                        $model->cust_name=$_GET['AftermarketCustInfo']['cust_name'];
                        $model->createtime_start=$_GET['AftermarketCustInfo']['createtime_start'];
                        $model->createtime_end=$_GET['AftermarketCustInfo']['createtime_end'];
                }
		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        /**
	 * 新分客户
	 */
	public function actionNewList()
	{
		$model=new AftermarketCustInfo('searchNewList');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AftermarketCustInfo'])){
			$model->attributes=$_GET['AftermarketCustInfo'];  
                        $model->cust_name=$_GET['AftermarketCustInfo']['cust_name']; 
                        $model->qq=$_GET['AftermarketCustInfo']['qq'];
                        $model->dept=$_GET['AftermarketCustInfo']['dept'];
                        $model->group=$_GET['AftermarketCustInfo']['group'];
                }
		$this->render('newlist',array(
			'model'=>$model,
		));
	}
        /**
	 * 今日联系
	 */
	public function actionTodayList()
	{
		$model=new AftermarketCustInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AftermarketCustInfo'])){
			$model->attributes=$_GET['AftermarketCustInfo'];
                        $model->cust_name=$_GET['AftermarketCustInfo']['cust_name']; 
                        $model->qq=$_GET['AftermarketCustInfo']['qq'];
                        $model->dept=$_GET['AftermarketCustInfo']['dept'];
                        $model->group=$_GET['AftermarketCustInfo']['group'];
                }
		$this->render('todaylist',array(
			'model'=>$model,
		));
	}
         /**
	 * 遗留数据
	 */
	public function actionOldList()
	{
		$model=new AftermarketCustInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AftermarketCustInfo'])){
			$model->attributes=$_GET['AftermarketCustInfo'];
                        $model->cust_name=$_GET['AftermarketCustInfo']['cust_name']; 
                        $model->qq=$_GET['AftermarketCustInfo']['qq'];
                        $model->dept=$_GET['AftermarketCustInfo']['dept'];
                        $model->group=$_GET['AftermarketCustInfo']['group'];
                }
		$this->render('oldlist',array(
			'model'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CustomerInfo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CustomerInfo::model()->findByPk($id); 
                
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CustomerInfo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='customer-info-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        /**
         * 获取类目数组
         * @return type
         */
        public function getCategoryArr(){
            $sql ="select code,name from {{dic}} where ctype='cust_category'";
            return CHtml::listData(Dic::model()->findAllBySql($sql), 'code', 'name');
        }
        
        /**
         * 获取部门数组 
         */
        public function getDeptArr() {
             $deptarr = DeptInfo::model()->findAll();
             $dept_empty = new DeptInfo();
             $dept_empty->id=0;
             $dept_empty->name='--请选择部门--';
             $deptarr=array_merge(array($dept_empty), $deptarr);
             return CHtml::listData($deptarr, "id","name");
        }
        /**
         * 获取部门下组别数组 
         */
        public function getDeptGroupArr($deptid,$isajax) { 
            if($isajax){
                $sql ="select t.group_id,g.name as group_name from {{dept_group}} t left join {{group_info}} g on t.group_id=g.id where t.dept_id=:dept_id"; 
                $grouparr = DeptGroup::model()->findAllBySql($sql,array(':dept_id'=>$deptid));
                $group_empty = new DeptGroup();
                $group_empty->group_id=0;
                $group_empty->group_name='--请选择组别--';
                $grouparr=array_merge(array($group_empty), $grouparr); 
                echo json_encode($grouparr); 
            }else{
                $sql ="select t.group_id,g.name as group_name from {{dept_group}} t left join {{group_info}} g on t.group_id=g.id where t.dept_id=:dept_id";
                $grouparr = DeptGroup::model()->findAllBySql($sql,array(':dept_id'=>$deptid));
                $group_empty = new DeptGroup();
                $group_empty->group_id=0;
                $group_empty->group_name='--请选择组别--';
                $grouparr=array_merge(array($group_empty), $grouparr);  
                return CHtml::listData($grouparr, 'group_id', 'group_name'); 
            } 
            
        }
         /**
         * 获取部门,组别下的用户数组 
         */
        public function getUserArr($deptid,$groupid,$isajax) {
            if($isajax){ 
                $sql ="select id,name from {{users}} where `dept_id`=:dept_id and `group_id`=:group_id"; 
                $userarr = Users::model()->findAllBySql($sql,array(':dept_id'=>$deptid,':group_id'=>$groupid));
                $userarr=array_merge(array('0'=>'--请选择用户--'), $userarr);
                echo json_encode($userarr);
            }else{ 
                $sql = "select id ,name  from {{users}}  where dept_id=:dept_id and group_id=:group_id";
                $userarr = Users::model()->findAllBySql($sql,array(':dept_id'=>$deptid,':group_id'=>$groupid));
                $user_empty = new Users();
                $user_empty->id='0';
                $user_empty->name='--请选择用户--';
                $userarr=array_merge(array($user_empty), $userarr);
                return CHtml::listData($userarr, 'id','name');
            }
        }
         /**
         * 获取客户分类数组
         * @return type
         */
        public function getCustTypeArr(){
            $sql ="select type_no,type_name from {{cust_type}} where lib_type='3'"; 
            return CHtml::listData(CustType::model()->findAllBySql($sql), 'type_no', 'type_name');
        }
        /**
         * 拔打电话
         * @param type $cust_id
         */
        public function actionDial($cust_id){
            $result = array('status'=>0,'dial_id'=>123,'message'=>'dial ok');
            echo json_encode($result);
        }
        
        /**
         * 发短信
         * @param type $cust_id
         */
        public function actionMessage($cust_id){  
            $model =  new AftermarketCustInfo();
            $model->cust_id=$cust_id; 
            if(isset($_POST['AftermarketCustInfo'])){  
                 $model->attributes=$_POST['AftermarketCustInfo'];
                 $model->message=$_POST['AftermarketCustInfo']['message']; 
                 $ret = Utils::sendMessageByCust($model->cust_id,$model->message,'post');
                 Utils::showMsg(1,$ret); 
                 Yii::app()->end;
                 exit();
            }  
            $this->renderPartial('message',array(
			'model'=>$model,
		));
        }
        /**
         * 发邮件
         * @param type $cust_id
         */
        public function actionMail($cust_id){
            echo 'Mail ok';
        }
        /**
         * 监听电话
         * @param type $cust_id
         */
        public function actionListen($cust_id){
            echo 'Listen ok';
        }
        /**
         * ajax获取部门下组别数组 
         * @param type $deptid
         * @param type $isajax
         * @return type
         */
        public function actionDeptGroupArr($deptid,$isajax) { 
            if($isajax){
                $sql ="select t.group_id,g.name as group_name from {{dept_group}} t left join {{group_info}} g on t.group_id=g.id where t.dept_id=:dept_id"; 
                $grouparr = DeptGroup::model()->findAllBySql($sql,array(':dept_id'=>$deptid));
                $group_empty = new DeptGroup();
                $group_empty->group_id=0;
                $group_empty->group_name='--请选择组别--';
                $grouparr=array_merge(array($group_empty), $grouparr); 
                echo json_encode($grouparr);
            }else{
                $sql ="select t.group_id,g.name as group_name from {{dept_group}} t left join {{group_info}} g on t.group_id=g.id where t.dept_id=:dept_id";
                $grouparr = DeptGroup::model()->findAllBySql($sql,array(':dept_id'=>$deptid));
                $group_empty = new DeptGroup();
                $group_empty->group_id=0;
                $group_empty->group_name='--请选择组别--';
                $grouparr=array_merge(array($group_empty), $grouparr);  
                return CHtml::listData($grouparr, 'group_id', 'group_name'); 
            } 
            
        }
        /**
         * ajax 获取部门,组别下所有用户数组 
         * @param type $deptid
         * @param type $groupid
         */
        public function actionUserArr($deptid,$groupid) {
            $sql ="select id,name from {{users}} where `dept_id`=:dept_id and `group_id`=:group_id";
            $userarr=Users::model()->findAllBySql($sql,array(':dept_id'=>$deptid,':group_id'=>$groupid));
            $user_empty = new Users();
            $user_empty->id='0';
            $user_empty->name='--请选择用户--';
            $userarr=array_merge(array($user_empty), $userarr);
            echo json_encode($userarr);
        }
         
}
