<?php

class FinanceController extends GController
{
	public function actionPerformance()
	{
		$enoNum = Yii::app()->db2->createCommand("select * from {{users}} where extension=:extension")->queryAll(TRUE,array(":extension"=>'822'));
		echo '<pre>';
		print_r($enoNum);die;
		$model = new Finance;
		$deptArr = Userinfo::getDept();
		$deptArr = array_merge(array('0'=>'--请选择部门--'), $deptArr);
		$this->render('performance',array(
			'model'=>$model,
			'deptArr'=>$deptArr)
		);
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}