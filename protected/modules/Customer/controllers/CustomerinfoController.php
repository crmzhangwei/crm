<?php

class CustomerinfoController extends GController
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
			//'postOnly + delete', // we only allow deletion via POST request
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
		$model=new CustomerInfo;
		$deptArr = Userinfo::getDept();
		$deptArr = array('0'=>'--请选择部门--') + $deptArr;
		$category = Userinfo::getCategory();//类目
		if(isset($_POST['CustomerInfo']))
		{

			$model->attributes=$_POST['CustomerInfo'];
     		$model->assign_eno = Yii::app()->session['user']['eno'];//分配人
			$model->assign_time = time();//分配时间
			$model->create_time = time();
			$model->creator = Yii::app()->user->id;
			$model->cust_type = 0;	//客户分类默认为0
 		   if($model->save()){
				Yii::app()->db->createCommand()->update('{{Users}}',array('cust_num' =>new CDbExpression('cust_num+1')),"eno='{$model->eno}'");
				//Users::model()->updateAll(array('cust_num'=>'cust_num+1'),'eno=:eno',array(":eno"=>$model->eno)); 
				//exit("<script>alert(\"恭喜你, 成功添加一条记录。\");javascript:history.go(-1);</script>");
				Utils::showMsg (1, '增加成功!');
			}else{
				$errors = $model->getErrors();
				$error = current($errors) ;
					Utils::showMsg (0, $error[0]);
			}
			
            Yii::app()->end();
		}
		
		$this->renderPartial('create',array(
			'model'=>$model,
			'deptArr'=>$deptArr,
			'category'=>$category
		));
	}

	public function actionGetGroup(){
		$deptid = yii::app()->request->getparam('deptid');
		$deptinfo = Userinfo::getGroupById($deptid);
		echo json_encode($deptinfo);
	}

	public function actiongetUsers()
	{
		$gid = Yii::app()->request->getparam('gid');
        $deptid = Yii::app()->request->getparam('deptid');
		$userinfo = Userinfo::getUserbygid($gid, $deptid);
		echo json_encode($userinfo);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id=0)
	{
		
		$id = $id ? $id: $_POST['CustomerInfo']['id'];
		$model=$this->loadModel($id);
		$eno = $model->eno ?$model->eno :0;
		$param['eno'] = (string)$eno;
		
		$userinfo = Users::model()->findByAttributes($param);
		$user_info['group_id'] = $userinfo?$userinfo->group_id:0;
		$user_info['dept_id']  = $userinfo?$userinfo->dept_id:0;
	    $user_info['name']     = $userinfo?$userinfo->name:0;
		$user_info['eno']     = $userinfo?$userinfo->eno:0;
		$user_info['group_arr'] = Userinfo::getGroupById($user_info['dept_id']);
		$user_info['user_arr'] = Userinfo::getUserbygid($user_info['group_id'],$user_info['dept_id']);	
		if(isset($_POST['CustomerInfo']))
		{
			$model->attributes=$_POST['CustomerInfo'];
			$aNewEno = $model->eno;
			$aOldEno = $model->oldEno;
			if($aNewEno == $aOldEno){//没有修改所属工号
				if($model->save()){
					//exit("<script>alert(\"恭喜你, 数据修改成功。\");javascript:history.go(-2);</script>");
					Utils::showMsg (1, '恭喜你, 修改成功!');
				}
				else
				{
					$errors = $model->getErrors();
					$error = current($errors) ;
					Utils::showMsg (0, $error[0]);
				}
			}
			else{
				$model->assign_eno = Yii::app()->session['user']['eno'];//分配人
				$model->assign_time = time();//分配时间
				$sql = "update {{users}} set cust_num=cust_num+1 where eno='{$aNewEno}'";
				$sql2 = "update {{users}} set cust_num=cust_num-1 where eno='{$aOldEno}'";
				$transaction = Yii::app()->db->beginTransaction();
				try {
					if($model->save()){
						$res = Yii::app()->db->createCommand($sql)->execute();
						$res2 = Yii::app()->db->createCommand($sql2)->execute();
						$transaction->commit();
						//exit("<script>alert(\"恭喜你, 数据修改成功。\");javascript:history.go(-2);</script>");
						Utils::showMsg (1, '恭喜你, 修改成功!');
					}
					else
					{
						throw new CHttpException(400,Yii::t('yii','Your request is invalid.'));
					}
				} catch (Exception $exc) {
					$transaction->rollBack();//事务回滚
					$errors = $model->getErrors();
					$error = current($errors) ;
					Utils::showMsg (0, $error[0]);
					//exit("<script>alert(\"对不起, 本次操作失败, 请重新操作1。\");javascript:history.go(-2);</script>");	
				}	
			}
			Yii::app()->end();
		}
		$category = $this->getCategory();
		$deptArr = Userinfo::getDept();
		$deptArr = array('0'=>'--请选择部门--') + $deptArr;
		$this->renderPartial('update',array(
			'model'=>$model,
			'category'=>$category,
			'deptArr'=>$deptArr,
			'user_info'=>$user_info,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$sql = "update {{customer_info}} set `status`=2 where id=$id";
		$sql2 = "update {{users}} set cust_num=cust_num-1 where eno='{$model->eno}'";//删除一条记录后对应的所属工号人员已分配减1
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$res = Yii::app()->db->createCommand($sql)->execute();
			$res2 = Yii::app()->db->createCommand($sql2)->execute();
			$transaction->commit();
			exit("<script>alert(\"恭喜你, 删除成功。\");javascript:history.go(-1);</script>");
		} catch (Exception $exc) {
			$transaction->rollBack();//事务回滚
			$errors = $model->getErrors();
			$error = current($errors) ;
			exit("<script>alert(\"对不起, 本次操作失败, 请重新操作1。\");javascript:history.go(-2);</script>");	
		}
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
			//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{	
		$model=new CustomerInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(Yii::app()->request->getParam('customerId')){
			$model->customerId = Yii::app()->request->getParam('customerId');
			//Yii::app()->db->createCommand()->delete('{{tip_info}}',"id in( {$model->customerId} )"); 
		}
		if(isset($_GET['CustomerInfo']))
			$model->attributes=$_GET['CustomerInfo'];
		
		//部门组别人员三级联动
		$uInfo = Userinfo::secondlevel();
		$this->render('admin',array(
			'model'=>$model,	
			'deptArr'=>$uInfo['deptArr'],
			'groupArr'=>$uInfo['groupArr'],
			'infoArr'=>$uInfo['infoArr'],
			'user_info'=>$uInfo['user_info'],
		));
	}
    
	public function actionBatchCustomer(){
		$model = new CustomerInfo;
		if ($_FILES) {
	        $file = $_FILES['batchFile']['tmp_name'];
	        $fileArr = UploadExcel::upExcel($file);
	        $creator = Yii::app()->user->id;
			$eno = Yii::app()->session['user']['eno'];
	        $create_time = time();
	        if ($fileArr) {
	        	$sql = "insert into {{customer_info}} (cust_name,phone,qq,mail,memo,creator,create_time,eno) values";
	        	foreach ((array)$fileArr as $k => $v) {
	        		if (!$v[0]) {
	        			exit("<script>alert(\"对不起, 第".$k."行中的客户姓名不能为空, 请填写后重新提交。\");
	        				javascript:history.go(-1);</script>");
	        		}
	        		elseif (!$v[1] && !$v[2]) {
	        			exit("<script>alert(\"对不起, 第".$k."行中的电话和QQ二选一必填, 请填写后重新提交。\");
	        				javascript:history.go(-1);</script>");
	        		}
	        		elseif ($v[3] && !preg_match('/^[\w\_\.]+@[\w\_]+[\.\w+]+$/', $v[3])) {//邮箱匹配, 非必填项
	        			exit("<script>alert(\"对不起, 第".$k."行中的邮箱格式不正确, 请填写后重新提交。\");
	        				javascript:history.go(-1);</script>");
	        		}
	        		else{
	        			$sql .= "('{$v[0]}','{$v[1]}','{$v[2]}','{$v[3]}','{$v[4]}', $creator, $create_time,'$eno'),";
	        		}	
	        	}
	        	$sql = trim($sql,',');
	        	$command=yii::app()->db->createCommand($sql);
	        	$num = $command->execute();
	        	exit("<script>alert(\"恭喜你, 成功导入".$num."条数据。\");javascript:history.go(-1);</script>");	
	        }
		}
		$this->renderPartial('batchCustomer', array('model'=>$model));
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

	public function  get_eno_text($data)
	{
		$val = $data->eno;
		$enoArr = $this->getEnoArr($val);
		$res = isset($enoArr[$val])? $enoArr[$val]:$val;
		return $res;
	}

	public function getEnoArr($eno){
		return CHtml::listData(Users::model()->findAll('eno=:eno', array(':eno'=>$eno)), 'eno', 'name');
	}
	
	public function get_assign_text($data){
		$val = $data->assign_eno;
		$assignArr = $this->getAssignArr($val);
		$res = isset($assignArr[$val]) ? $assignArr[$val] : $val;
		return $res;
	}
	
	public function getAssignArr($assign){
		return Chtml::listData(Users::model()->findAll('eno=:eno', array(':eno'=>$assign)), 'eno', 'name');
	}
	
	public function get_category_text($data){
		$val = $data->category;
		$categoryArr = $this->getCategory();
		$res = isset($categoryArr[$val]) ? $categoryArr[$val] : $val;
		return $res;
	}
	
	public function getCategory(){
		return Userinfo::getCategory();
	}
	
	public function get_assign_time($data){
		return $data->assign_time ? date("Y-m-d H:i:s",$data->assign_time) : '未分配';
	}
	/**
	 *批量导入EXCEL模板文件下载
	 */
	public function actionGetTemplate(){
		/////header("Content-type:text/html;charset=utf-8"); 
		$file_name="customerInfo.xlsx"; 
		//用以解决中文不能显示出来的问题 
		/////$file_name=iconv("utf-8","gb2312",$file_name); 
		$file_sub_path=$_SERVER['DOCUMENT_ROOT']."/document/"; 
		$file_path=$file_sub_path.$file_name; 
		//首先要判断给定的文件存在与否 
		if(!file_exists($file_path)){ 
			echo "没有该文件文件"; 
			return ; 
		} 
		/////$fp=fopen($file_path,"r"); 
		/////$file_size=filesize($file_path); 
		//下载文件需要用到的头 
		Header("Content-type: application/octet-stream"); 
		Header("Accept-Ranges: bytes"); 
		/////Header("Accept-Length:".$file_size); 
		/////Header("Content-Disposition: attachment; filename=".$file_name); 
		/////$buffer=1024; 
		/////$file_count=0; 
		//向浏览器返回数据 
		/*while(!feof($fp) && $file_count<$file_size){ 
			$file_con=fread($fp,$buffer); 
			$file_count+=$buffer; 
			echo $file_con; 
		} 
		fclose($fp); */
		header("Content-Disposition: attachment; filename=".basename($file_path));
		readfile($file_path);
	}
	
	public function actionDelTipInfo(){
		$custId = Yii::app()->request->getParam('custId');
		Yii::app()->db->createCommand()->delete('{{tip_info}}',"id in( $custId )"); 
	}
}
