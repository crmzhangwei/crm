<?php

class FinanceController extends GController
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
				'actions'=>array('index','view','test'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','create','PopCustList','DeptGroupArr','UserArr','test'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Finance;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Finance']))
		{
			$model->attributes=$_POST['Finance'];
                        //增加创建人，增加时间 
                        $acct_time = $model->getAttribute("acct_time");
                        $iAcctTime=  strtotime($acct_time);
                        $model->setAttribute("acct_time", $iAcctTime);
                        $model->setAttribute("creator", Yii::app()->user->id);
                        $model->setAttribute("create_time", time());
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Finance']))
		{
			$model->attributes=$_POST['Finance'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
		$dataProvider=new CActiveDataProvider('Finance');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
         /**
	 * 弹出客户列表数据
	 */
	public function actionPopCustList()
	{
		$model=new CustomerInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CustomerInfo']))
			$model->attributes=$_GET['CustomerInfo'];
		 
                if(isset($_GET['isajax'])){
                    $this->renderPartial('_custlist',array(
			'model'=>$model,
                    )); 
                }else{
                    $this->renderPartial('custlist',array(
			'model'=>$model,
                    )); 
                }        
		
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Finance('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['Finance'])){
			$model->attributes=$_POST['Finance'];
                        $model->cust_name=$_POST['Finance']['cust_name'];
                        $model->createtime_start=$_POST['Finance']['createtime_start'];
                        $model->createtime_end=$_POST['Finance']['createtime_end'];
                        $model->dept=$_POST['Finance']['dept'];
                        $model->group=$_POST['Finance']['group'];
                        $model->shopname=$_POST['Finance']['shopname'];
                        $model->phone=$_POST['Finance']['phone'];
                }
                $this->render('admin',array(
			'model'=>$model,
                    ));        
		
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Finance the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Finance::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Finance $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='finance-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        /**
         * 获取部门数组 
         */
        public function getDeptArr() {
             return CHtml::listData(DeptInfo::model()->findAll(), 'id', 'name');
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
                echo json_encode(DeptGroup::model()->findAllBySql($sql,array(':dept_id'=>$deptid)));
            }else{
                $sql ="select t.group_id,g.name as group_name from {{dept_group}} t left join {{group_info}} g on t.group_id=g.id where t.dept_id=:dept_id";
                return CHtml::listData(DeptGroup::model()->findAllBySql($sql,array(':dept_id'=>$deptid)), 'group_id', 'group_name');
            } 
            
        }
         /**
         * 获取部门,组别下的用户数组 
         */
        public function getUserArr($deptid,$groupid,$isajax) {
            if($isajax){ 
                $sql ="select id,name from {{users}} where `dept_id`=:dept_id and `group_id`=:group_id"; 
                echo json_encode(Users::model()->findAllBySql($sql,array(':dept_id'=>$deptid,':group_id'=>$groupid)));
            }else{ 
             return CHtml::listData(Users::model()->findAll("`dept_id`=:dept_id and `group_id`=:group_id",array(':dept_id'=>$deptid,':group_id'=>$groupid)), 'id', 'name');
            }
        }
         
        /**
         * 获取所有谈单师用户数组 
         * need to do when role has done.
         */
        public function getAllTransUser() {
            $sql ="select id,name from {{users}} t where exists (select 1 from {{user_role}} where role_id=1 and user_id=t.id  )"; 
            return  CHtml::listData(Users::model()->findAllBySql($sql),'id','name');
        }
        /**
         * ajax 获取部门,组别下所有用户数组 
         * @param type $deptid
         * @param type $groupid
         */
        public function actionUserArr($deptid,$groupid) {
            $sql ="select id,name from {{users}} where `dept_id`=:dept_id and `group_id`=:group_id"; 
            echo json_encode(Users::model()->findAllBySql($sql,array(':dept_id'=>$deptid,':group_id'=>$groupid)));
        }
        
        
        public function actionTest() {
           $content="上周A股市场风格出现分化，在大盘蓝筹股的带动下主板市场屡创新高。面对不断冲高的大盘，市场的恐高心理也有所增加，业内人士认为，近期，在大盘加速冲刺阶段积累了巨量短线获利盘，市场面临巨大的技术性调整压力。当然，也有券商机构喊出，“牛市将持续三年到五年”上周A股市场风格出现分化上周A股市场风格出现分化，，。上周A股市场风格出现分化上周A股市场风格出现";
                  
           //Utils::sendMessage("13536580119", $content,"post"); 
           //Utils::sendMessage("18589075186", $content,"post"); 
            
        }

    function Get($phone,$msg) {
        $sms = Yii::app()->params['SMS'];
                $ch = curl_init();
                $timeout = 15;
                $postdata=array('uid'=>$sms['uid'],
                            'auth'=>$sms['auth'],
                            'expid'=>$sms['expid'],
                            'encode'=>$sms['encode'],
                            'mobile'=>$phone,
                            'msg'=>$msg
                    );
                $sUrl = $sms['url']."?expid=0&uid=".$sms['uid']."&auth=".$sms['auth']."&encode=".$sms['encode']."&mobile=".$phone."&msg=".$msg;
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HEADER,true);
                curl_setopt($ch,CURLOPT_HTTPHEADER,array("chaetset=utf-8"));
                //curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata); // Post提交的数据包
                curl_setopt($ch, CURLOPT_URL, $sUrl);
                //curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
                
                 curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $result = curl_exec($ch);
                curl_close($ch);
                echo $result;
        return $result;
    }
}