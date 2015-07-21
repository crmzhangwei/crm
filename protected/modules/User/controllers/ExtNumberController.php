<?php

class ExtNumberController extends GController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ExtNumber('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['ExtNumber']))
			$model->attributes=$_GET['ExtNumber'];
		
		$this->render('admin',array(
			'model'=>$model,
		));
	}
        public function actionListen($ext){
            $user = Users::model()->findByPk(Yii::app()->user->id);
            $srcExt = $user->extend_no; 
            $ret = UnCall::listen($srcExt, $ext);
            echo json_encode($ret);
        }
		
	public function get_uname($data){
		$val = $data->extension;
		$uArr = Users::model()->findAll('extend_no=:extend_no', array(':extend_no'=>$val));
		return $uArr ? $uArr[0]['username'] : '未使用';
	}
}
