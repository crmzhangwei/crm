<?php

class NoteTemplateController extends GController
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
		$model=new NoteTemplate;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['NoteTemplate']))
		{
			$model->attributes=$_POST['NoteTemplate'];
			if($model->save()){
				Utils::showMsg (1, '增加成功!');
			}
			else
			{
				$errors = $model->getErrors();
				$error = current($errors) ;
				Utils::showMsg (0, $error[0]);
			}
			Yii::app()->end();
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
	public function actionUpdate($id=0)
	{
		$id = $id ? $id: $_POST['NoteTemplate']['id'];
		$model=$this->loadModel($id);
		if(isset($_POST['NoteTemplate']))
		{
			$model->attributes=$_POST['NoteTemplate'];
			if($model->save()){
				Utils::showMsg (1, '修改成功!');
			}
			else
			{
				//exit("<script>alert(\"对不起, 本次修改失败, 请重新操作。\");javascript:history.go(-1);</script>");
				$errors = $model->getErrors();
				$error = current($errors) ;
				Utils::showMsg (0, $error[0]);	
			}	
			Yii::app()->end();
		}

		$this->renderPartial('update',array(
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
		$dataProvider=new CActiveDataProvider('NoteTemplate');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new NoteTemplate('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['NoteTemplate']))
			$model->attributes=$_GET['NoteTemplate'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return NoteTemplate the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=NoteTemplate::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param NoteTemplate $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='note-template-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
