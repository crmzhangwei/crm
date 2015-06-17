<?php

/*
 * 金轮电话系统接口 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UnCall {

    /**
     * 根据客户id 拔打客户电话
     * 1.根据客户id，取客户信息
     * 2.根据当前登录用户，取用户信息
     * 3.调用金轮接口拔打电话
     * 4.返回结果
     * @param type $cust_id 客户id
     */
    public static function dial($cust_id) {
        $cust = CustomerInfo::model()->findByPk($cust_id);
        if (empty($cust)) {
            return "客户不存在";
        }
        $user = Users::model()->findByPk(Yii::app()->user->id);
        if (empty($user)) {
            return "请先登录系统";
        }
        $ret= array('status'=>0,'dial_id'=>0,'message'=>'');
        $uncall = Yii::app()->params['UNCALL'];
        $client = new SoapClient($uncall['webservice']);
        $result = $client->OnClickCall($user->extend_no, $cust->phone, "");
        $xml = simplexml_load_string($result);
        if (((string)$xml->OnClickCall->Response) == 'success') {
            $dialdetail = new DialDetail();
            $dialdetail->eno = $user->eno;
            $dialdetail->cust_id = $cust_id;
            $dialdetail->extend_no = $user->extend_no;
            $dialdetail->phone = $cust->phone;
            $dialdetail->dial_time = time();
            $dialdetail->dial_long = 0;
            $dialdetail->dial_num = 1;
            $dialdetail->record_path = '';
            $dialdetail->isok =0;
            $dialdetail->uid = '';
            $dialdetail->save();
            $ret['status']=1;
            $ret['dial_id']=$dialdetail->primaryKey;
            $ret['message']='电话拔打成功，请按下接听!';
        }else{ 
            $ret['message']='电话拔打失败!';
        }
        return $ret;
    }

    /**
     * 监听电话
     * @param type $srcExtend 发起监听的分机号
     * @param type $targetExtend 被监听的分机号
     */
    public static function listen($srcExtend, $targetExtend) {
        $user = Users::model()->findByPk(Yii::app()->user->id);
        if (empty($user)) {
            return "请先登录系统";
        }
        $uncall = Yii::app()->params['UNCALL'];
        $client = new SoapClient($uncall['webservice']);
        $result = $client->listen($targetExtend, $srcExtend);
        return $result;
    }

    /**
     * 获取通话录音路径
     * @param type $uid 通话用户id
     */
    public static function getRecord($uid) {
        $user = Users::model()->findByPk(Yii::app()->user->id);
        if (empty($user)) {
            return "请先登录系统";
        }
        $uncall = Yii::app()->params['UNCALL'];
        $client = new SoapClient($uncall['webservice']);
        $result = $client->getRecording($uid);
        return $result;
    }

    /**
     * 获取通话时长
     */
    public static function getDialLength($uid) {
        return 12;
    }

    /**
     * 获取拔话记录主键
     * @param type $extend_no
     */
    public static function getUid($extend_no) {
        $uncall = Yii::app()->params['UNCALL'];
        $client = new SoapClient($uncall['webservice']);
        $result = $client->popEvent($extend_no);
        return $result;
    }

}
?>

