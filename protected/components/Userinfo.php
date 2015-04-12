<?php

class Userinfo
{
	/**
	*获取公共组别信息
	*/
	/*public static function getGroup()
	{
		$modelgroup = GroupInfo::model();
		$groupArr =  CHtml::listData(GroupInfo::model()->findAll(), 'id', 'name');
		return $groupArr;
	}*/

	public static function getUserbygid($gid)
	{
     	$modelgroup = Yii::app()->db->createCommand()
	    ->select('eno, username')
	    ->from('{{users}}')
	    ->where('group_id=:id', array(':id'=>$gid))
	    ->queryAll();
	    $Users = array();
	    foreach ($modelgroup as $key => $value) {
	    	$Users[$value['eno']] = $value['username'];
	    }
        return $Users;
	}

	public static function getGroupById($deptid){
		
		$allData = Yii::app()->db->createCommand("select g.`group_id`,i.`name` from `c_dept_group` as g left join `c_group_info` as i 
			on g.`group_id`=i.`id` where dept_id = :deptid")->queryAll(TRUE,array(":deptid"=>$deptid));
		$groupArr = array();
		foreach ($allData as $k => $v) {
			$groupArr[$v['group_id']] = $v['name'];
		}
		return $groupArr;
	}

	public static function getDept(){
		$modelDept = DeptInfo::model();
		$deptArr = CHtml::listData($modelDept->findAll(),'id', 'name');
		return $deptArr;
	}

}