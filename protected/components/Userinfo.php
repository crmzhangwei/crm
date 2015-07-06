<?php

class Userinfo
{
	/**
	 *获取所有类目
	 *return array
	 */
	public static function getCategory(){
		$category = Yii::app()->db->createCommand()
		->select('code, name')
		->from('{{dic}}')
		->where('ctype=:type', array(':type'=>'cust_category'))
		->queryAll();
		$categoryArr = array();
		foreach ($category as $key => $value) {
			$categoryArr[$value['code']] = $value['name'];
		}
		return $categoryArr;
	}

	public static function getUserbygid($gid, $deptid)
	{
            $where = $gid=='-1' ? "ismaster=1 and dept_id=$deptid and username<>'admin'" : "group_id=:id and ismaster<>1 and username<>'admin'";//-1为精英组
            $modelgroup = Yii::app()->db->createCommand()
                ->select('eno, username, cust_num')
                ->from('{{users}}')
                ->where($where, array(':id'=>$gid))
                ->queryAll();
	    $Users = array();
	    foreach ($modelgroup as $key => $value) {
	    	$Users[$value['eno']] = $value['username'].' (已分配'."$value[cust_num]".')' ;
	    }
        return $Users;
	}
        
        public static function getUserbygidanddid($gid, $deptid)
	{
            $where = ($gid=='-1')? "ismaster=1 and dept_id=$deptid and username<>'admin'" : ($gid=='0'?"dept_id=$deptid and ismaster<>1 and username<>'admin'":"dept_id=$deptid and group_id=:id and ismaster<>1 and username<>'admin'") ;//-1为精英组
            
            $modelgroup = Yii::app()->db->createCommand()
                ->select('id, username, cust_num')
                ->from('{{users}}')
                ->where($where, array(':id'=>$gid))
                ->queryAll();
	    $Users = array();
	    foreach ($modelgroup as $key => $value) {
	    	$Users[$value['id']] = $value['username'] ;
	    }
            return $Users;
	}
        public static function getAllUserbygidanddid($gid, $deptid)
	{
            $where = ($gid=='0'?"dept_id=$deptid and username<>'admin'":"dept_id=$deptid and group_id=:id and username<>'admin'") ;//-1为精英组
             
            $modelgroup = Yii::app()->db->createCommand()
                ->select('id, username, cust_num')
                ->from('{{users}}')
                ->where($where, array(':id'=>$gid))
                ->queryAll();
	    $Users = array();
	    foreach ($modelgroup as $key => $value) {
	    	$Users[$value['id']] = $value['username'] ;
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
                if($deptid != 0){
                    $groupArr['-1'] = '精英组';
                }
		return $groupArr;
	}

	public static function getDept(){
		$modelDept = DeptInfo::model();
		$deptArr = CHtml::listData($modelDept->findAll(),'id', 'name');
		return $deptArr;
	}

	public static function genCustTypeArray() {
			$custTypeArr = Utils::mapArray(CustType::findByType(1), 'type_no', 'type_name');
			$custTypeArr[-1] = '--请选择客户分类--';
			ksort($custTypeArr);
			return $custTypeArr;
        }
        /**
         * 取出manager id 为$managerid 的所有用户及其下属用户列表
         * @param type $managerid
         * @return type Array
         */
        public static function getAllChildUsersId($managerid){
            $user = Users::model()->findByPk($managerid);
            if(empty($user)){
                return null;
            }
            $ret = array();
            $allData = Yii::app()->db->createCommand("select id from `c_users` where manager_id = :manager_id")->queryAll(TRUE,array(":manager_id"=>$managerid));
            foreach ($allData as $k => $v) {
			$ret[] = $v['id'];
                        $temps = UserInfo::getAllChildUsersId($v['id']); 
                        if($temps!=null&&!empty($temps)){
                            $ret = array_merge($ret,$temps);
                        }
	    }
            return $ret;
        }
         /**
         * 取出部门deptid及其下属部门列表
         * @param type $deptid 部门id
         * @return type Array
         */
        public static function getAllChildDeptId($deptid){
            $dept = DeptInfo::model()->findByPk($deptid);
            if(empty($dept)){
                return null;
            }
            $ret = array();
            $allData = Yii::app()->db->createCommand("select id from `c_dept_info` where parent_id = :parent_id")->queryAll(TRUE,array(":parent_id"=>$deptid));
            foreach ($allData as $k => $v) {
			$ret[] = $v['id'];
                        $temps = UserInfo::getAllChildDeptId($v['id']); 
                        if($temps!=null&&!empty($temps)){
                            $ret = array_merge($ret,$temps);
                        }
	    }
            return $ret;
        }
        /**
         * 取出manager id 为$managerid 的所有用户及其下属用户列表
         * @param type $managerid
         * @return type Array
         */
        public static function getAllChildUsersEno($managerid){
            $user = Users::model()->findByPk($managerid);
            if(empty($user)){
                return null;
            }
            $ret = array();
            $allData = Yii::app()->db->createCommand("select id,eno from `c_users` where manager_id = :manager_id")->queryAll(TRUE,array(":manager_id"=>$managerid));
            foreach ($allData as $k => $v) {
			$ret[] = $v['eno'];
                        $temps = UserInfo::getAllChildUsersEno($v['id']); 
                        if($temps!=null&&!empty($temps)){
                            $ret = array_merge($ret,$temps);
                        }
	         }
            return $ret;
        } 
	
	/**
	 *根据name查工号(eno)
	 */
	public static function getEnoByName($name){
		return Users::model()->find('name=:name', array(':name'=>$name));
	}
 
}