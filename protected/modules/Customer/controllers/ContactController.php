<?php

class ContactController extends GController {

    public function actionIndex() {
        $model = new DialDetailP('search');
        $model->unsetAttributes();
        if (isset($_GET['DialDetailP'])) {
            $model->attributes = $_GET['DialDetailP'];
            $model->searchtype = $_GET['DialDetailP']['searchtype'];
            $model->keyword = $_GET['DialDetailP']['keyword'];
            $model->timetype = $_GET['DialDetailP']['timetype'];
            if($model->timetype==0){
                $model->stime = $_GET['DialDetailP']['stime'];
                $model->etime = $_GET['DialDetailP']['etime'];
            } 
            $model->dept = $_GET['search']['dept'];
            $model->group = $_GET['search']['group'];
        }
        //部门组别人员三级联动
        $uInfo = Userinfo::secondlevel();
        $this->render("index", array(
            'model' => $model,
            'deptArr' => $uInfo['deptArr'],
            'groupArr' => $uInfo['groupArr'],
            'user_info' => $uInfo['user_info'],
            'infoArr' => $uInfo['infoArr'],));
    } 
    public function actionViewCust($custid){
        $model = CustomerInfo::model()->findByPk($custid);
        if($model->cust_type==6){
            //成交师
            $this->redirect(Yii::app()->createUrl("TransChance/customerInfo/edit", array("id"=>$custid)));  
        }else{
             $this->redirect(Yii::app()->createUrl("Chance/customerInfo/edit", array("id"=>$custid)));  
        }
    }
    public function actionSyncByDate() {
        $model = new DialDetailP('search');
        if (!isset($_GET['DialDetailP']) || empty($_GET['DialDetailP']['sync_date'])) {
            $model->addError("sync_date", "请选择同步日期");
            $this->render("index", array('model' => $model));
            return;
        }
        $cdate = date('Y-m-d');
        $idate = strtotime($cdate);
        $model->attributes = $_GET['DialDetailP'];
        $isyncdatetime = strtotime($model->sync_date);
        if ($isyncdatetime > $idate) {
            $model->addError("sync_date", "同步日期不能大于当前日期");
            $this->render("index", array('model' => $model));
            return;
        }
        $curdate = date("Y_n_j", $isyncdatetime);
        $table = "cdro_" . $curdate; 
        $dial_time='0';
        $result = Yii::app()->db->createCommand("select max(dial_time) as dial_time from {{dial_detail_p}} where from_unixtime(dial_time,'%Y-%m-%d')=:dial_time")->queryRow(TRUE,array(':dial_time'=>$model->sync_date));
        if ($result && is_array($result)) {
            $dial_time = $result['dial_time'];
        }
        $synctime = date("Y-m-d",$isyncdatetime)." 00:00:00";
        $sql = "select calldate,src,dst,billsec,uniqueid,userfield from $table where 1=1 and calldate>:synctime";
        $result = Yii::app()->db3->createCommand($sql)->queryAll(TRUE, array(":synctime" => $synctime));
        if ($result && is_array($result)) {
            foreach ($result as $key => $record) {
                $userid = $this->getUserid($record['src'], $record['dst']);
                $model = new DialDetailP();
                $model->userid = 0;
                $model->cust_id =$this->getCustId($record['src'], $record['dst']);
                $model->dial_long = $record['billsec'];
                $model->dial_time = strtotime($record['calldate']);
                $model->uid = $record['uniqueid'];
                $model->record_path = $record['userfield'];
                $model->extend_no = $record['src'];
                $model->phone = $record['dst'];
                $model->save();
            }
        }
        $model = new DialDetailP('search');
        $this->render("index", array('model' => $model));
        return;
    }

    public function actionSyncByUid($uid) {
        $sql = "select uid,userid,cust_id,extend_no,phone,dial_time,dial_long,record_path from {{dial_detail_p}} where uid=:uid";
        $model = DialDetailP::model()->findBySql($sql, array(":uid" => $uid));
        $model->userid = $this->getUserid($model->extend_no, $model->phone);
        $model->cust_id = $this->getCustId($model->extend_no, $model->phone); 
        if($model->userid&&$model->cust_id){
            $sql = "update {{dial_detail_p}} set userid=:userid,cust_id=:custid where uid=:uid";
            Yii::app()->db->createCommand($sql)->execute(array(':userid'=>$model->userid,':custid'=>$model->cust_id,':uid'=>$uid));
            echo "匹配完成!";
        }else{
            echo "未能匹配到相应用户和客户!"; 
        }  
        return;
    }

    private function getCustId($src, $dst) {
        $id = 0;
        $length = strlen($dst);
        $phone = $dst;
        if ($length == 4) {
            $phone = $src;
        }
        $sql = "select id from {{customer_info}} where phone =:phone order by id desc limit 1";
        $result = Yii::app()->db->createCommand($sql)->queryRow(TRUE, array(":phone" => $phone));
        if ($result && is_array($result)) {
            $id = $result['id'];
            return $id;
        }
        if ($id == 0) {
            $sql = "select id from {{customer_info}} where phone2=:phone order by id desc limit 1";
            $result = Yii::app()->db->createCommand($sql)->queryRow(TRUE, array(":phone" => $phone));
            if ($result && is_array($result)) {
                $id = $result['id'];
                return $id;
            }
        }
        if ($id == 0) {
            $sql = "select id from {{customer_info}} where phone3=:phone order by id desc limit 1";
            $result = Yii::app()->db->createCommand($sql)->queryRow(TRUE, array(":phone" => $phone));
            if ($result && is_array($result)) {
                $id = $result['id'];
                return $id;
            }
        }
        if ($id == 0) {
            $sql = "select id from {{customer_info}} where phone4=:phone order by id desc limit 1";
            $result = Yii::app()->db->createCommand($sql)->queryRow(TRUE, array(":phone" => $phone));
            if ($result && is_array($result)) {
                $id = $result['id'];
                return $id;
            }
        }
        if ($id == 0) {
            $sql = "select id from {{customer_info}} where phone5=:phone order by id desc limit 1";
            $result = Yii::app()->db->createCommand($sql)->queryRow(TRUE, array(":phone" => $phone));
            if ($result && is_array($result)) {
                $id = $result['id'];
                return $id;
            }
        }
        return $id;
    }

    private function getUserid($src, $dst) {
        $id = 0;
        $extend_no = $src;
        $length = strlen($dst);
        if ($length == 4) {
            $extend_no = $dst;
        }
        $sql = "select id from {{users}} where extend_no =:extend_no order by id desc limit 1";
        $result = Yii::app()->db->createCommand($sql)->queryRow(TRUE, array(":extend_no" => $extend_no));
        if ($result && is_array($result)) {
            $id = $result['id'];
        }
        return $id;
    }
    public function getTotal($conditions){
         $sql = "select count(1) as tcount,sum(dial_long) as tlong from {{dial_detail_p}} t left join {{customer_info}} c on t.cust_id=c.id left join {{users}} u on u.id=t.userid where 1=1";
         if(!empty($conditions)){
              $sql=$sql." and ". $conditions;
         } 
         $result = Yii::app()->db->createCommand($sql)->queryRow(TRUE);
         if ($result && is_array($result)) {
            return $result;
        }else{
            return array('tcount'=>0,'tlong'=>0);
        }
        
    }
}
