<?php

class Userinfo
{
	/**
	*获取公共组别信息
	*/
	public static function getGroup()
	{
		$modelgroup = GroupInfo::model();
		$groupArr =  CHtml::listData(GroupInfo::model()->findAll(), 'id', 'name');
		return $groupArr;
	}

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

}