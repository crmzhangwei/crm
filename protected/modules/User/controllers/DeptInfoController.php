<?php

class DeptInfoController extends GController
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
		$model=new DeptInfo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DeptInfo']))
		{
			$model->attributes=$_POST['DeptInfo'];
                        
			if($model->save())
			 Utils::showMsg (1, '部门增加成功!');
                         else
                           Utils::showMsg (0, '部门增加失败!');
		}

		$this->renderPartial('update',array(
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
           
                $id = $id ? $id: $_POST['DeptInfo']['id'];
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DeptInfo']))
		{
			$model->attributes=$_POST['DeptInfo'];
                        if(!empty($model->parent_id)&&$model->parent_id==$model->id){
                            Utils::showMsg (0, '上级部门不能等于当前部门!');
                            exit;
                        }
			if($model->save())
			   Utils::showMsg (1, '部门修改成功!');
                         else
                           Utils::showMsg (0, '部门修改失败!');
                         exit;
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
		$dataProvider=new CActiveDataProvider('DeptInfo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DeptInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DeptInfo']))
			$model->attributes=$_GET['DeptInfo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DeptInfo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DeptInfo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DeptInfo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='dept-info-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function get_parent_text($data){
                $val = $data->parent_id;
                $res = "";
                if(!empty($val)){
                    $dept = DeptInfo::model()->findByPk($val); 
                    $res = $dept->name;
                } 
		return $res;
        }
        
        public function getDeptList(){
            $deptarr = DeptInfo::model()->findAll();
            $empty = new DeptInfo();
            $empty->id='';
            $empty->name='请选择上级部门'; 
            $list = array_merge(array($empty), $deptarr);
            return CHtml::listData($list, 'id', 'name');
        }
}
