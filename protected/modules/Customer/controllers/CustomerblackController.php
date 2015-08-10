<?php

class CustomerblackController extends GController
{
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
		$model=new CustomerBlack;
		$deptArr = Userinfo::getDept();
		$deptArr = array('0'=>'--请选择部门--' + $deptArr);
		$category = Userinfo::getCategory();//类目
		if(isset($_POST['CustomerBlack']))
		{
			$model->attributes=$_POST['CustomerBlack'];

			$model->assign_eno = Yii::app()->session['user']['eno'];//分配人
			$model->assign_time = time();//分配时间
			$model->create_time = time();
			$model->creator = Yii::app()->user->id;
			$model->cust_type = 0;	//客户分类默认为0
			if($model->save()){
				Yii::app()->db->createCommand()->update('{{Users}}',array('cust_num' =>new CDbExpression('cust_num+1')),"eno='{$model->eno}'");
				//Users::model()->updateAll(array('cust_num'=>'cust_num+1'),'eno=:eno',array(":eno"=>$model->eno)); 
				exit("<script>alert(\"恭喜你, 成功添加一条记录。\");javascript:history.go(-1);</script>");
			}
		}

		$this->renderPartial('create',array(
			'model'=>$model,
			'deptArr'=>$deptArr,
			'category'=>$category
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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['CustomerBlack']))
		{
			$model->attributes=$_POST['CustomerBlack'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
                    'model'=>$model,
                    'category'=>$category,
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
		$dataProvider=new CActiveDataProvider('CustomerBlack');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CustomerBlack('search');
		$model->unsetAttributes();  // clear any default values
		$custtype = Userinfo::genCustTypeArray();
		if(isset($_GET['CustomerBlack']))
			$model->attributes=$_GET['CustomerBlack'];

		$this->render('admin',array(
			'model'=>$model,
			'custtype'=>$custtype
		));
	}
    
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CustomerBlack the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CustomerBlack::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CustomerBlack $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='customer-info-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function getCust($val){
		$res =  Yii::app()->db->createCommand()
				->select('cust_type')
				->from('{{black_info}}')
				->where("cust_id = $val")
				->queryRow();
		return $res ? current($res) : '';
	}
	public function get_cust_type($data){
		$val = $data->id;
		$res = $this->getCust($val);
		return $res;
	}
        public function get_old_cust_type($data){
            $libtype = $data->lib_type;
            $typeno = $data->old_cust_type;
            $res =  Yii::app()->db->createCommand()
				->select('type_name')
				->from('{{cust_type}}')
				->where("lib_type = $libtype and type_no=$typeno")
				->queryRow();
            return $res ? current($res) : '';
        }
	/**
	 *领取公海资源
	 */
	public function actionGetResource(){
		$model=new CustomerBlack;
		$eno = Yii::app()->session['user']['eno'];
		$ids = Yii::app()->request->getParam('ids');
		$sql = "update {{customer_info}} set `status`=3,cust_type=0,eno='$eno' where id in ($ids)";
		$sql2 = "delete from {{black_info}} where cust_id in ($ids)";
               
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$res = Yii::app()->db->createCommand($sql)->execute();
		    $res2 = Yii::app()->db->createCommand($sql2)->execute();
			$transaction->commit();
			echo json_encode(true);
		} catch (Exception $exc) {
			$transaction->rollBack();//事务回滚
			echo json_encode(false);
		}
	}
}
