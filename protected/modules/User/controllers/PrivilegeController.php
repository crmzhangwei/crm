<?php

class PrivilegeController extends GController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

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
        //var_dump($pids);
        $pids = $pids ?$pids :array();
        $insert = array_diff($pids,  $resArr);

        $noinsert = array_uintersect($pids, $resArr,"strcasecmp");  //求交集
        if($noinsert != $resArr)
        {
            $cir = new CDbCriteria;
            $cir ->addCondition( "role_id = $roleid");
            $cir->addnotInCondition('menu_id', $noinsert);
            $res1 = Privilege::model()->deleteAll($cir);
          
        }
        if($insert)
        {
             foreach ($insert as $v){
                $insertRows[] = array('role_id'=>$roleid,'menu_id'=>$v);
              }
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
