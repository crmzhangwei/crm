<?php

/*
 * 金轮电话系统接口 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class UnCall{
    
    /**
     * 根据客户id 拔打客户电话
     * 1.根据客户id，取客户信息
     * 2.根据当前登录用户，取用户信息
     * 3.调用金轮接口拔打电话
     * 4.返回结果
     * @param type $cust_id 客户id
     */
    public static function dial($cust_id){
        $cust = CustomerInfo::model()->findByPk($cust_id);
        if(empty($cust)){
            return "客户不存在";
        }
        $user = Users::model()->findByPk(Yii::app()->user->id);
        if(empty($user)){
            return "请先登录系统";
        }
        $uncall = Yii::app()->params['UNCALL'];
        $client = new nusoap_client($uncall['webservice'],true); 
        
    }
    /**
     * 监听电话
     * @param type $srcExtend 发起监听的分机号
     * @param type $targetExtend 被监听的分机号
     */
    public static function listen($srcExtend,$targetExtend){
        
    }
    
    /**
     * 获取通话录音路径
     * @param type $uid 通话用户id
     */
    public static function getRecord($uid){
        
    }
    /**
     * 获取通话时长
     */
    public static function getDialLength(){
        
    }
}

?>

