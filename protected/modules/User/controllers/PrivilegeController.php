<?php

class PrivilegeController extends GController
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
		$model=new Privilege;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Privilege']))
		{
			$model->attributes=$_POST['Privilege'];
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

		if(isset($_POST['Privilege']))
		{
			$model->attributes=$_POST['Privilege'];
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
            
                
		$dataProvider=new CActiveDataProvider('Privilege');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));

        $this->render("index",array('priv' => $priv));
       }


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
                $permission = $this->getPriv();
		$model=new Privilege('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Privilege']))
			$model->attributes=$_GET['Privilege'];

		$this->render('admin',array(
			'model'=>$model,
                        'permission'=>json_encode($permission),
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Privilege the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Privilege::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        private function getPriv() {
          
        $dataProvider=new CActiveDataProvider('MenuInfo');
        $dataProvider->pagination->pageSize = 1000;
        $data = $dataProvider->getData();
        if($data)
        {
            foreach ($data as $obj)
            {
                $priv[] = $obj->attributes;
            }
            foreach ($priv as &$v)
            {
                 $v['text'] = $v['name'];
                 $v['icon'] =  ' ace-icon fa fa-flag ';
            }
            
                    
        }
             $tree = new Tree($priv, array('id', 'parent_id'));
             $priv = $tree->leaf(0);

        return $priv;
    }
    
    
      /**
     * 点击人员查看相应的角色
     */
    public function actionSelectRolePermission() {
        $roleid = intval(Yii::app()->request->getParam("roleid"));
        if ( $roleid) {
            $res = Privilege::model()->findAll("role_id = $roleid");
            $result = array();
            if($res)
            {
              foreach ( $res as $val)
                {
                 $val->id = $val->menu_id;
                 $result[] =  $val->attributes;
                }  
            }
            
            echo $result?json_encode($result):'';
        }
    }

       /**
     * 角色权限分配
     */
    public function actionAssignRolePermission() {
        $roleid = Yii::app()->request->getParam('roleid');
        $pids = Yii::app()->request->getParam('pids');
        $res = 0;
        $res = $this->AssignrolePermission($roleid, $pids);
        if (intval($res) == 1)
            Utils::showMsg(1, '角色权限分配成功!');
        else
            Utils::showMsg(0, '角色权限分配失败!');
    }
    /**
     * 分配角色权限的方法
     * @param int   $roleid
     * @param array $pids  
     */
    
    public function AssignrolePermission($roleid,$pids)
    {
        $res = $res1 = $res2 = 0;
        $res = Privilege::model()->findAll("role_id = $roleid");
        $resArr = $insertRows = array();
        $res = Utils::objtoarray($res);
        if($res)
        {
            foreach ($res as $v){
               $resArr[] =$v['menu_id'];
            }
        }
        $insert = array_diff($pids,  $resArr);
        $noinsert = array_uintersect($pids, $resArr,"strcasecmp");  //求交集
        if($noinsert && $noinsert != $pids)
        {
            $cir = new CDbCriteria;
            $cir ->addCondition( "role_id = $roleid");
            $cir->addnotInCondition('menu_id', $noinsert);
            $res1 = Privilege::model()->deleteAll($cir);
            
        }
        foreach ($insert as $v){
            $insertRows[] = array('role_id'=>$roleid,'menu_id'=>$v);
        }
        
        if($insertRows)
           $res2 = Utils::insertSeveral('privilege', $insertRows);
        return $res1||$res2 ?true:false;
    }

	/**
	 * Performs the AJAX validation.
	 * @param Privilege $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='privilege-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
