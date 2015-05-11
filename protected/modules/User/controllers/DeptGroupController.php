<?php

class DeptGroupController extends GController
{
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DeptGroup('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DeptGroup']))
			$model->attributes=$_GET['DeptGroup'];
                $permission = $this->getPriv();
		$this->render('admin',array(
			'model'=>$model,
                        'permission'=>json_encode($permission),
		));
	}

	public function actionAdmin2()
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
          
       //$dataProvider=new CActiveDataProvider('MenuInfo');
         $dataProvider=new CActiveDataProvider('GroupInfo');
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
            $res = DeptGroup::model()->findAll("dept_id = $roleid");
            $result = array();
            if($res)
            {
              foreach ( $res as $val)
                {
                 $val->id = $val->group_id;
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
            Utils::showMsg(1, '部门组别设置成功!');
        else
            Utils::showMsg(0, '部门组别设置失败!');
    }
    /**
     * 部门组别设置的方法
     * @param int   $roleid
     * @param array $pids  
     */
    
    public function AssignrolePermission($roleid,$pids)
    {
        $res = $res1 = $res2 = 0;
        $res =  DeptGroup::model()->findAll("dept_id = $roleid");
        $resArr = $insertRows = array();
        $res = Utils::objtoarray($res);
        if($res)
        {
            foreach ($res as $v){
               $resArr[] =$v['group_id'];
            }
        }
        //var_dump($pids);
        $insert = array_diff($pids,  $resArr);
       
        $noinsert = array_uintersect($pids, $resArr,"strcasecmp");  //求交集
        if($noinsert != $resArr)
        {
            $cir = new CDbCriteria;
            $cir ->addCondition( "dept_id = $roleid");
            $cir->addnotInCondition('group_id', $noinsert);
            $res1 = Privilege::model()->deleteAll($cir);
          
        }
        if($insert)
        {
            foreach ($insert as $v){
                $insertRows[] = array('dept_id'=>$roleid,'group_id'=>$v);
            }
        }
        
        if($insertRows)
           $res2 = Utils::insertSeveral('dept_group', $insertRows);
        return $res1||$res2 ?true:false;
    }

}

