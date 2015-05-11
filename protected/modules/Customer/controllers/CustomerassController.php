<?php

class CustomerassController extends GController
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
	public function actionAssign()
	{
		$model=new CustomerAss;
		$deptArr = Userinfo::getDept();
		$deptArr = array_merge(array('0'=>'--请选择部门--'), $deptArr);
		$category = Userinfo::getCategory();//类目
		$ids = Yii::app()->request->getParam('ids');
		$model->ids = $ids;
		if(isset($_POST['CustomerAss']))
		{
			$model->attributes=$_POST['CustomerAss'];
			$eno = $model->eno;
			$enoNum = Yii::app()->db->createCommand("select cust_num from {{users}} where eno=:eno")->queryAll(TRUE,array(":eno"=>$eno));
			$enoNum = $enoNum ? (int)$enoNum[0]['cust_num'] : 0;//该用户已分配的资源数
			$assCount = explode(',', $model->ids);
			$assCount = count($assCount);//待分配的资源个数
			if( ($assCount + $enoNum) > 300 ){//每个用户的分配资源数不能超过300个
				exit("<script>alert(\"对不起, 该用户当前已分配了".$enoNum."个资源, 每个用户最多只能分配300个资源, 本次操作失败。\");javascript:history.go(-1);</script>");
			}
			else{
				if(empty($eno))
				{
					exit("<script>alert('请选择分配的用户');javascript:history.go(-1);</script>");
				}
				Yii::app()->db->createCommand()->update('{{customer_info}}',array('eno' =>$eno),"id in({$model->ids})");
				Yii::app()->db->createCommand()->update('{{Users}}',array('cust_num' =>new CDbExpression("cust_num+$assCount")),"eno='{$model->eno}'");
				exit("<script>alert(\"恭喜你, 成功分配了".$assCount."个资源。\");javascript:history.go(-1);</script>");
			}
		}
		$this->renderPartial('assign_form',array(
			'model'=>$model,
			'deptArr'=>$deptArr,
			'category'=>$category,
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
		$dataProvider=new CActiveDataProvider('CustomerAss');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CustomerAss('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CustomerAss']))
			$model->attributes=$_GET['CustomerAss'];

		$this->render('admin',array(
			'model'=>$model,	
		));
	}
    
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CustomerAss the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CustomerAss::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CustomerAss $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='customerass-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}



	
	
	
}
