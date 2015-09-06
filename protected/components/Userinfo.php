<?php

class Userinfo {

    /**
     * 获取所有类目
     * return array
     */
    public static function getCategory() {
        $category = Yii::app()->db->createCommand()
                ->select('code, name')
                ->from('{{dic}}')
                ->where('ctype=:type', array(':type' => 'cust_category'))
                ->queryAll();
        $categoryArr = array();
        foreach ($category as $key => $value) {
            $categoryArr[$value['code']] = $value['name'];
        }
        return $categoryArr;
    }

    public static function getUserbygid($gid, $deptid) {
        $where = $gid == '-1' ? "ismaster=1 and dept_id=$deptid and username not like 'admin%'" : " dept_id=:deptid and group_id=:id and ismaster<>1 and username not like 'admin%'"; //-1为精英组
        $modelgroup = Yii::app()->db->createCommand()
                ->select('eno, name, cust_num')
                ->from('{{users}}')
                ->where($where, array(':deptid' => $deptid, ':id' => $gid))
                ->queryAll();
        $Users = array(0 => '--请选择人员--');
        foreach ($modelgroup as $key => $value) {
            $Users[$value['eno']] = $value['name'] . ' (已分配' . "$value[cust_num]" . ')';
        }
        return $Users;
    }

    public static function getUserbygidanddid($gid, $deptid) {
        $where = ($gid == '-1') ? "ismaster=1 and dept_id=$deptid and username<>'admin'" : ($gid == '0' ? "dept_id=$deptid and ismaster<>1 and username<>'admin'" : "dept_id=$deptid and group_id=:id and ismaster<>1 and username<>'admin'"); //-1为精英组

        $modelgroup = Yii::app()->db->createCommand()
                ->select('id, username, cust_num')
                ->from('{{users}}')
                ->where($where, array(':id' => $gid))
                ->queryAll();
        $Users = array();
        foreach ($modelgroup as $key => $value) {
            $Users[$value['id']] = $value['username'];
        }
        return $Users;
    }

    public static function getAllUserbygidanddid($gid, $deptid) {
        $where = ($gid == '0' ? "dept_id=$deptid and username<>'admin'" : "dept_id=$deptid and group_id=:id and username<>'admin'"); //-1为精英组

        $modelgroup = Yii::app()->db->createCommand()
                ->select('id, username, cust_num')
                ->from('{{users}}')
                ->where($where, array(':id' => $gid))
                ->queryAll();
        $Users = array();
        foreach ($modelgroup as $key => $value) {
            $Users[$value['id']] = $value['username'];
        }
        return $Users;
    }

    public static function getGroupById($deptid, $type = '') {

        $allData = Yii::app()->db->createCommand("select g.`group_id`,i.`name` from `c_dept_group` as g left join `c_group_info` as i 
			on g.`group_id`=i.`id` where dept_id = :deptid")->queryAll(TRUE, array(":deptid" => $deptid));
        $groupArr = array(0 => '--请选择组--');
        foreach ($allData as $k => $v) {
            $groupArr[$v['group_id']] = $v['name'];
        }
        if (empty($type)) {
            if ($deptid != 0) {
                $groupArr['-1'] = '精英组';
            }
        }
        return $groupArr;
    }

    public static function getDept() {
        $modelDept = DeptInfo::model();
        $deptArr = CHtml::listData($modelDept->findAll(), 'id', 'name');
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
    public static function getAllChildUsersId($managerid) {
        $user = Users::model()->findByPk($managerid);
        if (empty($user)) {
            return null;
        }
        $ret = array();
        $allData = Yii::app()->db->createCommand("select id from `c_users` where manager_id = :manager_id")->queryAll(TRUE, array(":manager_id" => $managerid));
        foreach ($allData as $k => $v) {
            $ret[] = $v['id'];
            $temps = Userinfo::getAllChildUsersId($v['id']);
            if ($temps != null && !empty($temps)) {
                $ret = array_merge($ret, $temps);
            }
        }
        return $ret;
    }

    /**
     * 取出部门deptid及其下属部门列表
     * @param type $deptid 部门id
     * @return type Array
     */
    public static function getAllChildDeptId($deptid) {
        $dept = DeptInfo::model()->findByPk($deptid);
        if (empty($dept)) {
            return null;
        }
        $ret = array();
        $allData = Yii::app()->db->createCommand("select id from `c_dept_info` where parent_id = :parent_id")->queryAll(TRUE, array(":parent_id" => $deptid));
        foreach ($allData as $k => $v) {
            $ret[] = $v['id'];
            $temps = Userinfo::getAllChildDeptId($v['id']);
            if ($temps != null && !empty($temps)) {
                $ret = array_merge($ret, $temps);
            }
        }
        return $ret;
    }

    /**
     * 取出manager id 为$managerid 的所有用户及其下属用户列表
     * @param type $managerid
     * @return type Array
     */
    public static function getAllChildUsersEno($managerid) {
        $user = Users::model()->findByPk($managerid);
        if (empty($user)) {
            return null;
        }
        $ret = array();
        $allData = Yii::app()->db->createCommand("select id,eno from `c_users` where manager_id = :manager_id")->queryAll(TRUE, array(":manager_id" => $managerid));
        foreach ($allData as $k => $v) {
            $ret[] = $v['eno'];
            $temps = Userinfo::getAllChildUsersEno($v['id']);
            if ($temps != null && !empty($temps)) {
                $ret = array_merge($ret, $temps);
            }
        }
        return $ret;
    }

    /**
     * 根据name查工号(eno)
     */
    public static function getEnoByName($name) {
        //return Users::model()->find('name like :name', array(':name'=>"%".$name."%"));
        $res = Yii::app()->db->createCommand("select eno from `{{users}}` where name like :name")->queryAll(TRUE, array(":name" => "%" . $name . "%"));
        return $res;
    }

	/**
     * 根据name查工号(id)
     */
    public static function getIdByName($name) {
        //return Users::model()->find('name like :name', array(':name'=>"%".$name."%"));
        $res = Yii::app()->db->createCommand("select id from `{{users}}` where name like :name")->queryAll(TRUE, array(":name" => "%" . $name . "%"));
        return $res;
    }
	
    public static function getNameByEno($eno) {
        $ret = "";
        $user = Users::model()->find('eno=:eno', array(':eno' => $eno));
        if (!empty($user)) {
            $ret = $user->name;
        }
        return $ret;
    }

    public static function getNameById($id) {
        $ret = "";
        $user = Users::model()->findByPk($id);
        if (!empty($user)) {
            $ret = $user->name;
        }
        return $ret;
    }

    /**
     * 查询用户新分资源
     */
    public static function newResource($eno) {
        if ($eno) {
            $nSource = Yii::app()->db->createCommand("select id from `{{tip_info}}` where eno=:eno")->queryAll(TRUE, array(":eno" => $eno));
            $cusId = '';
            foreach ($nSource as $k2 => $v2) {
                $cusId .= $v2['id'] . ',';
            }
            return $cusId ? trim($cusId, ',') : '';
        }
    }
	
	/***
	 * 下次联系时间提醒contact_tip
	 */
	public static function contact_tip($eno) {
        if ($eno) {
			$ftime = time()+15*60;
			$stime = time();
            $nextTime = Yii::app()->db->createCommand("select id from `{{customer_info}}` where eno=:eno and next_time>=:stime and next_time<:ftime")
									->queryAll(TRUE, array(":eno" => $eno, ":stime"=>$stime, ":ftime"=>$ftime));
            $cusId = '';
            foreach ($nextTime as $k2 => $v2) {
                $cusId .= $v2['id'] . ',';
            }
            return $cusId ? trim($cusId, ',') : '';
        }
    }
	
    /**
     * 部门组别人员三级联动
     */
    public static function secondlevel($info=array()) {
        //部门 组别 二组联动
        $deptArr = Userinfo::getDept();
        $deptArr = array('0' => '--请选择部门--') + $deptArr;
        $groupArr = Userinfo::getGroupById(1);
        $groupArr = array('0' => '--请选择组别--') + $groupArr;
        $userid = Yii::app()->user->id;
        $infoArr = array();
        $user_info = array();
        if (Yii::app()->request->getParam('search')) {
            $infoArr['dept'] = isset($_GET['search']['dept']) ? $_GET['search']['dept'] : 0;
            $infoArr['group'] = isset($_GET['search']['group']) ? $_GET['search']['group'] : 0;
            $infoArr['users'] = isset($_GET['search']['users']) ? $_GET['search']['users'] : 0;
            $user_info['group_arr'] = Userinfo::getGroupById($infoArr['dept']);
            $user_info['user_arr'] = Userinfo::getUserbygid($infoArr['group'], $infoArr['dept']);
        } else if (!empty($info)) {
            $infoArr['dept'] = isset($info['dept']) ? $info['dept'] : 0;
            $infoArr['group'] = isset($info['group']) ? $info['group'] : 0;
            $infoArr['users'] = isset($info['users']) ? $info['users'] : 0;
            $user_info['group_arr'] = Userinfo::getGroupById($infoArr['dept']);
            $user_info['user_arr'] = Userinfo::getUserbygid($infoArr['group'], $infoArr['dept']);
        } else {
            $infoArr['dept'] = 0;
            $infoArr['group'] = 0;
            $infoArr['users'] = 0;
            $user_info['group_arr'] = 0;
            $user_info['user_arr'] = 0;
        }

        $ret = array();
        $ret['deptArr'] = $deptArr;
        $ret['groupArr'] = $groupArr;
        $ret['infoArr'] = $infoArr;
        $ret['user_info'] = $user_info;
        return $ret;
    }

    public static function getPrivCondiForReport() {
        $user_arr = Userinfo::getAllChildUsersId(Yii::app()->user->id);
        $user_arr[] = Yii::app()->user->id;
        $priv="";
        if (!empty($user_arr) && count($user_arr) > 0) {
            $priv = Utils::genUserConditionForReport($user_arr);
            $priv = " and (".$priv.")";
        }
        return $priv;
    }

}
