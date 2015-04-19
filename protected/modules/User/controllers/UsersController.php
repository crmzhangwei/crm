<?php

class UsersController extends GController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';


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
		$model=new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->renderPartial('create',array(
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

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
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
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        /**
         * 获取用户的角色数组
         */
        public function getRoleArr() {
            return CHtml::listData(RoleInfo::model()->findAll(), 'id', 'name');
        }
        
        /**
         * 获取用户所属组别数组 
         */
        public function getGroupArr() {
             return CHtml::listData(GroupInfo::model()->findAll(), 'id', 'name');
        }
        
        /**
         * 获取用户所属部門数组 
         */
        public function getDeptArr() {
             return CHtml::listData(DeptInfo::model()->findAll(), 'id', 'name');
        }
        /**
         * 获取状态数组
         */
        public function getStatusArr() {
            
            return array(1=>'在职',2=>'离职');
            
        }
        
        public function  get_dept_text($data)
        {
            $val = $data->dept_id;
            $dept = $this->getDeptArr();
            $res = isset($dept[$val])? $dept[$val]:$val;
            return $res;
        }
        
        public function  get_group_text($data)
        {
            $val = $data->group_id;
            $group =  $this->getGroupArr();
            $res = isset($group[$val])?$group[$val]:$val;
             return $res;
        }
        
        public function  get_ismaster_text($data)
        {
            $val = $data->ismaster;
            $ismaster = array(1=>'是',2=>'否');
            $res =  isset($ismaster[$val])?$ismaster[$val]:$val;
            return $res;
        }
        
        public function  get_status_text($data)
        {
            $val = $data->status;
            $status = $this->getStatusArr();
            $res =  isset($status[$val])?$status[$val]:$val;
            return $res;
        }
          
}
