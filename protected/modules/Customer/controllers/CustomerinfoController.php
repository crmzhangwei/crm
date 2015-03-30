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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CustomerInfo']))
		{
			$model->attributes=$_POST['CustomerInfo'];
			$model->create_time = strtotime($model->create_time);
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
			//print_r($_FILES['batchFile']['tmp_name']);
			$PHPExcel = new PHPExcel();
	        $PHPReader = new PHPExcel_Reader_Excel2007();
	        $file = $_FILES['batchFile']['tmp_name'];
	        if(!$PHPReader->canRead($file)){
	           	$PHPReader = new PHPExcel_Reader_Excel5();
	          	if(!$PHPReader->canRead($file)){
	             	return false;
	           }
	        }
	        
	        $PHPExcel = $PHPReader->load($file);
	        $currentSheet = $PHPExcel->getSheet(0);//读取第一个工作表
	        $allColumn = $currentSheet->getHighestColumn();//取得最大的列号
	        $allRow = $currentSheet->getHighestRow();//取得一共有多少行
	        /**从第二行开始输出，因为excel表中第一行为列名*/
	        $arr=array();
	        for($currentRow = 2;$currentRow <= $allRow;$currentRow++){
	            /**从第A列开始输出*/
	            for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){
	                $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue(); /*ord()将字符转为十进制数*/

	                /**如果输出汉字有乱码，则需将输出内容用iconv函数进行编码转换，如下将gb2312编码转为utf-8编码输出*/
	                //$arr[$currentRow][]=  iconv('utf-8','gb2312', $val)."＼t";
	                $arr[$currentRow][]=  trim($val);
	            }
	        }
	        //删除全部为空的行
	        foreach ($arr as $key=>$vals){
	            $tmp = '';
	            foreach($vals as $v){
	                $tmp .= $v;
	            }
	            if(!$tmp) unset($arr[$key]);
	        }
	        echo '<pre>';
	        print_r($arr);die();
	        return $arr;
		}
		$this->render('batchCustomer', array('model'=>$model));
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
