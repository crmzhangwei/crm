<?php

class UserRoleController extends GController
{
	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserRole('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserRole']))
			$model->attributes=$_GET['UserRole'];
                $permission = $this->getPriv();
		$this->render('admin',array(
			'model'=>$model,
                       'permission'=>json_encode($permission),
		));
	}
        
        
       

        private function getPriv() {
          
       //$dataProvider=new CActiveDataProvider('MenuInfo');
         $dataProvider=new CActiveDataProvider('RoleInfo');
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
      

        return $priv;
    }
    
    
      /**
     * 点击人员查看相应的组别
     */
    public function actionSelectRolePermission() {
        $roleid = intval(Yii::app()->request->getParam("roleid"));
        if ( $roleid) {
            $res = UserRole::model()->findAll("user_id = $roleid");
            $result = array();
            if($res)
            {
              foreach ( $res as $val)
                {
                 $val->id = $val->role_id;
                 $result[] =  $val->attributes;
                }  
            }
            
            echo $result?json_encode($result):'';
        }
    }

       /**
     * 部门组别设置
     */
    public function actionAssignRolePermission() {
        $roleid = Yii::app()->request->getParam('roleid');
        $pids = Yii::app()->request->getParam('pids');
        $res = 0;
        $res = $this->AssignrolePermission($roleid, $pids);
        if (intval($res) == 1)
            Utils::showMsg(1, '人员角色设置成功!');
        else
            Utils::showMsg(0, '人员角色设置失败!');
    }
    /**
     * 部门组别设置的方法
     * @param int   $roleid
     * @param array $pids  
     */
    
    public function AssignrolePermission($roleid,$pids)
    {
        $res = $res1 = $res2 = 0;
        $res =  UserRole::model()->findAll("user_id = $roleid");
        $resArr = $insertRows = array();
        $res = Utils::objtoarray($res);
        if($res)
        {
            foreach ($res as $v){
               $resArr[] =$v['role_id'];
            }
        }
        //var_dump($pids);
        $insert = is_array($pids)?array_diff($pids,  $resArr):'';
       
        $noinsert = is_array($pids)?array_uintersect($pids, $resArr,"strcasecmp"):'';  //求交集
        if($noinsert != $resArr)
        {
            $cir = new CDbCriteria;
            $cir ->addCondition( "user_id = $roleid");
            if($noinsert)
            $cir->addnotInCondition('role_id', $noinsert);
            $res1 = UserRole::model()->deleteAll($cir);
          
        }
        if($insert)
        {
            foreach ($insert as $v){
                $insertRows[] = array('user_id'=>$roleid,'role_id'=>$v);
            }
        }
        
        if($insertRows)
           $res2 = Utils::insertSeveral('user_role', $insertRows);
        return $res1||$res2 ?true:false;
    }
}
