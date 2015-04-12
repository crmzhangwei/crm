<?php

/**
 * Description of Utils
 *
 * @author Administrator
 */
class Utils {

    /**
     * 返回已$key值作为键的数组
     * @param type $array
     * @param type $key
     * @return type
     */
    public static function indexArray($array, $key) {
        $result = array();
        foreach ($array as $element) {
            $result[$element [$key]] = $element;
        }
        return $result;
    }

    /**
     * 返回已$from值做为键 $to做为值的一维关联数组
     * @param type $array
     * @param type $from
     * @param type $to
     * @return type
     */
    public static function mapArray($array, $from, $to) {
        $result = array();
        foreach ($array AS $element) {
            $result[$element[$from]] = $element[$to];
        }
        return $result;
    }
    /**
     * 隐藏电话号码中间4位
     * @param type $phone
     */
    public static function hidePhone($phone){
        return substr_replace($phone,'****',3,4); 
    }
    /**
     * 隐藏邮件地址中间3位
     * @param type $email
     */
    public static function hideEmail($email){
        return substr_replace($email,'****',3,3); 
    }
    /**
     * 隐藏QQ中间3位
     * @param type $qq 
     */
    public static function hideQq($qq){
        return substr_replace($qq,'****',3,3); 
    }
}
