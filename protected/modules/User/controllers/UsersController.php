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
                $userinfo =  array();
		$user_info['group_id'] = $userinfo?$userinfo->group_id:0;
		$user_info['dept_id']  = $userinfo?$userinfo->dept_id:0;
	        $user_info['name']     = $userinfo?$userinfo->username:0;
		$user_info['id']     = $userinfo?$userinfo->id:0;
		$user_info['group_arr'] = Userinfo::getGroupById($user_info['dept_id']);
		$user_info['user_arr'] = Userinfo::getUserbygidanddid($user_info['group_id'],$user_info['dept_id']);	
                $deptArr = Userinfo::getDept();
		$deptArr = array_merge(array('0'=>'--请选择部门--'), $deptArr);
		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users']; 
                        $validate = json_decode(CActiveForm::validate($model)) ;
                        if($validate)
                        {
                            $msg = current($validate);
                            Utils::showMsg(0,$msg);
                            Yii::app()->end;
                        }
			if($model->save())
                        {
                            $id = Yii::app()->db->getLastInsertID();
                            $this->beforeSave($id);
                            Utils::showMsg(1,'创建成功');
                        }  else {
                            $errors = $model->getErrors();
                            $error = current($errors);
                            Utils::showMsg(0,$error[0]); 
                        }
			 Yii::app()->end;	
		}

		$this->renderPartial('create',array(
			'model'=>$model,
                         'deptArr'=>$deptArr,
                        'user_info'=>$user_info,
		));
	}

       public function beforeSave($id) {
                   $eno = 'U'.$this->createEno($id);
                   $param['eno']=$eno;
                   Users::model()->updateByPk($id, $param);
       } 
        public function createEno($id)
        {
            $newNumber = substr(strval($id+10000),1,4);    
            return    $newNumber;
        }
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id=0)
	{
                $id = $id ? $id: $_POST['Users']['id'];
		$model=$this->loadModel($id);
                $mid = $model->manager_id ?$model->manager_id :0;
                $userinfo = Users::model()->findByPk($mid);
		$user_info['group_id'] = $userinfo?$userinfo->group_id:0;
		$user_info['dept_id']  = $userinfo?$userinfo->dept_id:0;
	        $user_info['name']     = $userinfo?$userinfo->username:0;
		$user_info['id']     = $userinfo?$userinfo->id:0;
                
		$user_info['group_arr'] = array(0=>'--请选择组别--')+ Userinfo::getGroupById($user_info['dept_id'],2);
                 
		$user_info['user_arr'] = Userinfo::getAllUserbygidanddid($user_info['group_id'],$user_info['dept_id']);	
       
		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users']; 
			if($model->save())
                        {
                             Utils::showMsg (1, '用户信息修改成功!');
                        } 
                        else
                        {
                            $error = $model->getErrors();
                            $error = current($error);
                            Utils::showMsg (0, "$error[0]");
                        }
                         
                         exit; 
		}
                $deptArr = Userinfo::getDept();
		$deptArr = array('0'=>'--请选择部门--') + $deptArr;
		$this->renderPartial('update',array(
			'model'=>$model,
                        'deptArr'=>$deptArr,
                        'user_info'=>$user_info,
		));
	}

        
       public function actionPublish()
        {
            $ids = Yii::app()->request->getParam('ids');
            $type = Yii::app()->request->getParam('type');
            $col = Yii::app()->request->getParam('col');
            if ($type == 'publish')
            {
                $display = 1;
            } elseif ($type == 'cancel_publish')
            {
                $display = 2;
            } else
            {
                Utils::showMsg(0,'设置失败');
            }
            $col = $col?'status':'ismaster';
            $sql = "UPDATE {{users}} SET {$col}={$display} WHERE id in ({$ids})";
            $status = Yii::app()->db->createCommand($sql)->execute();
            if (!isset($_REQUEST['ajax']))
            {
                $this->redirect(Yii::app()->request->urlReferrer);
            } else
            {
                $status ? Utils::showMsg(1,'设置成功') : Utils::showMsg(0, '操作失败，请重试！');
            }
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
        
        public function actionGetGroup(){
            $deptid = yii::app()->request->getparam('deptid');
            $deptinfo = Userinfo::getGroupById($deptid,2);
            echo json_encode($deptinfo);
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
        
        
	public function actiongetUsers()
	{
		$gid = Yii::app()->request->getparam('gid');
                $deptid = Yii::app()->request->getparam('deptid');
		$userinfo = Userinfo::getAllUserbygidanddid($gid, $deptid);
		echo json_encode($userinfo);
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
        public function getGroupArr($dept_id= 0) {
            
            $data = empty($dept_id)?GroupInfo::model()->findAll() :'';
             return CHtml::listData($data, 'id', 'name');
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
            $res = isset($group[$val])?$group[$val]:'未分组';
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
        
       public function  get_manager_id($data)
		{
			$val = $data->manager_id;
			$userinfo =  Users::model()->findByPk($val);
			$res = $userinfo ? $userinfo->username : '暂无上级';
			return $res;
		}
          
}
