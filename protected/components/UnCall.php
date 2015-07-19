<?php

/*
 * 金轮电话系统接口 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UnCall {

    public static function getZone($phonenumber){
        $uncall = Yii::app()->params['UNCALL'];
        if(!$uncall['enable_zone']){
            return false;
        }
        $current_city = $uncall['city'];
        $ret=false;
        $url = $uncall['zoneservice']; 
        $url = $url.$phonenumber;
        $result = file_get_contents($url); 
        $xml = simplexml_load_string($result); 
        if($xml){
            $msg = (string)$xml->retmsg;
            if(trim($msg)=='OK'){
                $city = (string)$xml->city;
                if($current_city!=trim($city)){
                    $ret=true;
                }
            }
        }
        return $ret;
    }
    /**
     * 根据客户id 拔打客户电话
     * 1.根据客户id，取客户信息
     * 2.根据当前登录用户，取用户信息
     * 3.调用金轮接口拔打电话
     * 4.返回结果
     * xml:
     * 
      <?xml version="1.0" encoding="utf-8"?>
      <uncall>
        <result>1</result>
        <OnClickCall>
            <Response>success</Response>
            <ActionID>123456</ActionID>
            <Message>Originate successfully queued</Message>
        </OnClickCall>
      </uncall>
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
        $ret = array('status' => 0, 'dial_id' => 0, 'message' => '');
        $uncall = Yii::app()->params['UNCALL'];
        $client = new SoapClient($uncall['webservice']);
        $phonenumber = $cust->phone;
        if(UnCall::getZone($phonenumber)&&substr($phonenumber,0,1)=="1"){
            $phonenumber="0".$phonenumber;
        }
        $result = $client->OnClickCall($user->extend_no, $phonenumber, ""); 
        $xml = simplexml_load_string($result);
        if ($xml&&((string) $xml->OnClickCall->Response) == 'Success') {
            $dialdetail = new DialDetail();
            $dialdetail->eno = $user->eno;
            $dialdetail->cust_id = $cust_id;
            $dialdetail->extend_no = $user->extend_no;
            $dialdetail->phone = $cust->phone;
            $dialdetail->dial_time = time();
            $dialdetail->dial_long = 0;
            $dialdetail->dial_num = 1;
            $dialdetail->record_path = '';
            $dialdetail->isok = 1;
            $dialdetail->uid = '';
            $dialdetail->save();
            $ret['status'] = 1;
            $ret['dial_id'] = $dialdetail->primaryKey;
            $ret['message'] = '电话拔打成功，请按下接听!';
        } else {
            $ret['message'] = '电话拔打失败!';
        }
        return $ret;
    }

    /**
     * 监听电话
     * 结果xml
     *<?xml version="1.0" encoding="utf-8"?>
      <uncall>
        <result>1</result>
        <monitorExten>
            <Response>success</Response>
            <Message>Spy or whisper success</Message>
        </monitorExten>
      </uncall>
     * @param type $srcExtend 发起监听的分机号
     * @param type $targetExtend 被监听的分机号
     */
    public static function listen($srcExtend, $targetExtend) {
        $ret = array('result'=>false,'message'=>'监听失败');
        $user = Users::model()->findByPk(Yii::app()->user->id);
        if (empty($user)) {
            $ret['message']='请先登录系统';
            return $ret;
        }
        $uncall = Yii::app()->params['UNCALL'];
        $client = new SoapClient($uncall['webservice']);
        $result = $client->listenCall($targetExtend, $srcExtend);
        $xml = simplexml_load_string($result);
        if($xml&&(string)$xml->result == '1'){
            $temp=(string)$xml->listenCall->Response;
            if($temp=='Success'){
                $ret['result']=true;
            }else{
                $ret['message']='监听失败'; 
            }
        }
        return $ret;
    }

    /**
     * 获取通话录音路径
     * 返回结果xml:
     *  
      <?xml version="1.0" encoding="utf-8"?>
      <uncall>
        <result>1</result>
        <getRecording>
            <files>audio:808-13632510278-20130625-093138-1372123897.17.WAV</files>
        </getRecording>
      </uncall>
     * 访问路径：http://XXX.XXX.XXX.XXX/outbound/index.php/RecordingAction/index.php?m=Public&a=record&uniqueid=audio:833-915999532020-20130807-155009-1375861809.4.WAV
     * @param type $uid 通话用户id
     */
    public static function getRecord($uid) {
        $user = Users::model()->findByPk(Yii::app()->user->id);
        if (empty($user)) {
            return "请先登录系统";
        }
        $record_name='';
        $uncall = Yii::app()->params['UNCALL'];
        $client = new SoapClient($uncall['webservice']);
        $result = $client->getRecording($uid);
        $xml = simplexml_load_string($result);
        if($xml&&(string)$xml->result == '1'){
            $record_name=(string)$xml->getRecording->files;
        }
        return $record_name;
    }

    /**
     * 获取通话时长
     */
    public static function getDialLength($uid) {
        $duration = 0;
        $result = Yii::app()->db3->createCommand("select duration from {{cdr}} where uniqueid=:uniqueid")->queryRow(TRUE, array(":uniqueid" => $uid));
        if (!empty($result) && is_array($result)) {
            $duration = $result['duration'];
        }
        return $duration;
    }

    /**
     * 获取拔话记录主键
     * 结果xml:
     * <?xml version="1.0" encoding="utf-8"?>
      <uncall>
        <result>1</result>
        <popEvent>
            <calla>802</calla>
            <callb>13421829060</callb>
            <uid>1111111111.111</uid>
            <status>callout</status>
        </popEvent>
      </uncall>
     * @param type $extend_no
     */
    public static function getUid($extend_no) {
        $uid='';
        $uncall = Yii::app()->params['UNCALL'];
        $client = new SoapClient($uncall['webservice']);
        $result = $client->popEvent($extend_no);
        $xml = simplexml_load_string($result);
        if($xml&&(string)$xml->result == '1'){
            $uid=(string)$xml->popEvent->uid;
        }
        return $uid;
    }

}
?>

