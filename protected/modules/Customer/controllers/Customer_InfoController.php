<?php

class Customer_InfoController extends GController
{
	public function actionCustomerList()
	{
		$customer_model = new Customer_Info;
		if (isset($_POST['Customer_Info'])) {
			foreach ($_POST['Customer_Info'] as $key => $value) {
				$customer_model->$key = $value;
			}
			echo '<pre>';
			print_r($customer_model);
		}
		$this->render('customerList', array('customer_model'=>$customer_model));
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