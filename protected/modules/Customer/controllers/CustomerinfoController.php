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
		$groupArr = Userinfo::getGroup();
		/*echo '<pre>';
		print_r($groupArr);die();*/
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['CustomerInfo']))
		{
			$model->attributes=$_POST['CustomerInfo'];
			$model->create_time = strtotime($model->create_time);
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->renderPartial('create',array(
			'model'=>$model,
			'groupArr'=>$groupArr,

		));
	}

	public function actiongetUsers()
	{
		$gid = Yii::app()->request->getparam('gid');
		$userinfo = Userinfo::getUserbygid($gid);
		echo json_encode($userinfo);
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

		if(isset($_POST['CustomerInfo']))
		{
			$model->attributes=$_POST['CustomerInfo'];
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
		if(isset($_GET['CustomerInfo']))
			$model->attributes=$_GET['CustomerInfo'];

		$this->render('admin',array(
			'model'=>$model,
			
		));
	}
    
	public function actionBatchCustomer(){
		$model = new CustomerInfo;
		if ($_FILES) {
	        $file = $_FILES['batchFile']['tmp_name'];
	        $fileArr = UploadExcel::upExcel($file);
	        $creator = Yii::app()->user->id;
	        $create_time = time();
	        if ($fileArr) {
	        	$sql = "insert into {{customer_info}} (cust_name,phone,qq,mail,memo,creator,create_time) values";
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
	        			$sql .= "('{$v[0]}','{$v[1]}','{$v[2]}','{$v[3]}','{$v[4]}', $creator, $create_time),";
	        		}	
	        	}
	        	$sql = trim($sql,',');
	        	$command=yii::app()->db->createCommand($sql);
	        	$num = $command->execute();
	        	exit("<script>alert(\"恭喜你, 成功插入".$num."条数据。\");javascript:history.go(-1);</script>");	
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


}
