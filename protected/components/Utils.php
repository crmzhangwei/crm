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
    
     /**
     * 向页面输出信息
     * @param int $code       错误代码, 0. 失败 1.成功， 默认为1
     * @param string $msg    信息内容， 默认为空
     * @param array $data    是否附带额外数据
     * @param boolean $return  是否返回信息内容，默认为true
     * @param boolean $exit  是否停止执行，默认为true
     */
    public static function showMsg($code = 1, $msg = '', $data = array(), $return = false, $exit = true) {
        $out = array('code' => $code, 'msg' => $msg);
        if (is_array($data) && count($data))
            $out['data'] = $data;
        if ($return)
            return $out;
        else
            echo json_encode($out);

        $exit && exit();
    }
}
