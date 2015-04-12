<?php

class ServiceController extends GController
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
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','admin','newList','todayList','oldList','dial','message','mail'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                $model->setAttribute("create_time", date("Y-m-d", $model->getAttribute("create_time")));
                $model->setAttribute("assign_time", date("Y-m-d", $model->getAttribute("assign_time")));
                $model->setAttribute("next_time", date("Y-m-d", $model->getAttribute("next_time")));
                $sharedNote = NoteInfo::model();
                $sharedNote->setAttribute("cust_id", $model->id); 
                $historyNote = NoteInfo::model();
                $historyNote->setAttribute("cust_id", $model->id);
                $noteinfo = new NoteInfo(); 
                $noteinfo->setAttribute("iskey", 0);
                $noteinfo->setAttribute("isvalid", 0);
                if($model->contract){
                    $model->contract['create_time']= date("Y-m-d",$model->contract['create_time']);
                    $model->contract['comm_pay_time']= date("Y-m-d",$model->contract['comm_pay_time']);
                    $model->contract['pay_time']= date("Y-m-d",$model->contract['pay_time']);
                }
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CustomerInfo']))
		{
			$model->attributes=$_POST['CustomerInfo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
                $user = Users::model()->findByPk(Yii::app()->user->id);
                
                
		$this->render('update',array(
			'model'=>$model,
                        'sharedNote'=>$sharedNote,
                        'historyNote'=>$historyNote,
                        'noteinfo'=>$noteinfo,
                        'loginuser'=>$user,
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
	 * 查询分配
	 */
	public function actionAdmin()
	{
		$model=new AftermarketCustInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AftermarketCustInfo']))
			$model->attributes=$_GET['AftermarketCustInfo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        /**
	 * 新分客户
	 */
	public function actionNewList()
	{
		$model=new AftermarketCustInfo('searchNewList');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AftermarketCustInfo'])){
			$model->attributes=$_GET['AftermarketCustInfo'];  
                        $model->cust_name=$_GET['AftermarketCustInfo']['cust_name']; 
                        $model->qq=$_GET['AftermarketCustInfo']['qq'];
                        $model->dept=$_GET['AftermarketCustInfo']['dept'];
                        $model->group=$_GET['AftermarketCustInfo']['group'];
                }
		$this->render('newlist',array(
			'model'=>$model,
		));
	}
        /**
	 * 今日联系
	 */
	public function actionTodayList()
	{
		$model=new AftermarketCustInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AftermarketCustInfo'])){
			$model->attributes=$_GET['AftermarketCustInfo'];
                        $model->cust_name=$_GET['AftermarketCustInfo']['cust_name']; 
                        $model->qq=$_GET['AftermarketCustInfo']['qq'];
                        $model->dept=$_GET['AftermarketCustInfo']['dept'];
                        $model->group=$_GET['AftermarketCustInfo']['group'];
                }
		$this->render('todaylist',array(
			'model'=>$model,
		));
	}
         /**
	 * 遗留数据
	 */
	public function actionOldList()
	{
		$model=new AftermarketCustInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AftermarketCustInfo'])){
			$model->attributes=$_GET['AftermarketCustInfo'];
                        $model->cust_name=$_GET['AftermarketCustInfo']['cust_name']; 
                        $model->qq=$_GET['AftermarketCustInfo']['qq'];
                        $model->dept=$_GET['AftermarketCustInfo']['dept'];
                        $model->group=$_GET['AftermarketCustInfo']['group'];
                }
		$this->render('oldlist',array(
			'model'=>$model,
		));
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
        /**
         * 获取类目数组
         * @return type
         */
        public function getCategoryArr(){
            $sql ="select code,name from {{dic}} where ctype='cust_category'";
            return CHtml::listData(Dic::model()->findAllBySql($sql), 'code', 'name');
        }
        
        /**
         * 获取部门数组 
         */
        public function getDeptArr() {
             return CHtml::listData(DeptInfo::model()->findAll(), 'id', 'name');
        }
         /**
         * 获取客户分类数组
         * @return type
         */
        public function getCustTypeArr(){
            $sql ="select type_no,type_name from {{cust_type}} where lib_type='3'"; 
            return CHtml::listData(CustType::model()->findAllBySql($sql), 'type_no', 'type_name');
        }
        /**
         * 拔打电话
         * @param type $cust_id
         */
        public function actionDial($cust_id){
            
        }
        /**
         * 发短信
         * @param type $cust_id
         */
        public function actionMessage($cust_id){
            
        }
        /**
         * 发邮件
         * @param type $cust_id
         */
        public function actionMail($cust_id){
            
        }
}
