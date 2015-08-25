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
        foreach ($array AS $k => $element) {
            $result[$element[$from]] = '【' . $element[$from] . '类】' . $element[$to];
        }
        return $result;
    }

    /**
     * 隐藏电话号码中间4位
     * @param type $phone
     */
    public static function hidePhone($phone) {
        return substr_replace($phone, '****', 3, 4);
    }

    /**
     * 隐藏邮件地址中间3位
     * @param type $email
     */
    public static function hideEmail($email) {
        return substr_replace($email, '****', 3, 3);
    }

    /**
     * 隐藏QQ中间3位
     * @param type $qq 
     */
    public static function hideQq($qq) {
        return substr_replace($qq, '****', 3, 3);
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

    /**
     * 
     * @param type $cust_id 客户id
     * @param type $msg 短信内容
     * @param type $method get/post
     * @return type 发送短信记录
     */
    public static function sendMessageByCust($cust_id, $seq, $msg, $method = 'get') {
        $cust = CustomerInfo::model()->findByPk($cust_id);
        if (empty($cust)) {
            return "客户不存在";
        }
        $phone = $cust->getAttribute("phone");
        switch ($seq) {
            case 1: break;
            case 2: $phone = $cust->getAttribute("phone2");
                break;
            case 3: $phone = $cust->getAttribute("phone3");
                break;
            case 4: $phone = $cust->getAttribute("phone4");
                break;
            case 5: $phone = $cust->getAttribute("phone5");
                break;
        }
        if (empty($phone)) {
            return "客户电话不存在";
        }
        $iret = Utils::sendMessage($phone, $msg, $method);

        $message = new Message();
        $message->setAttribute('cust_id', $cust_id);
        $message->setAttribute('phone', $phone);
        $message->setAttribute('content', $msg);
        $message->setAttribute('creator', Yii::app()->user->id);
        $message->setAttribute('create_time', time());
        $message->setAttribute('status', $iret);
        $message->setAttribute('memo', Yii::app()->params['SMS_RETURN_CODE'][$iret]);
        $message->save();
        return $message;
    }

    /**
     * 发送短信
     * @param type $phone 电话号码
     * @param type $msg 短信内容
     * @param type $method get/post
     * @return type $iReturnCode 状态码
     */
    public static function sendMessage($phone, $msg, $method = 'get') {
        $content = urlencode($msg);
        $sms = Yii::app()->params['SMS'];
        $result = ""; 
        if(!empty($phone)&&substr($phone,0,1)=="0"){
            $phone=substr($phone,1);
        }
        switch ($method) {
            case 'get':
                $sUrl = $sms['url'] . "?expid=0&uid=" . $sms['uid'] . "&auth=" . $sms['auth'] . "&encode=" . $sms['encode'] . "&mobile=" . $phone . "&msg=" . $content;
                $result = file_get_contents($sUrl);
                break;
            case 'post':
                $ch = curl_init(); 
                $postdata = "expid=0&uid=" . $sms['uid'] . "&auth=" . $sms['auth'] . "&encode=" . $sms['encode'] . "&mobile=" . $phone . "&msg=" . $content; 
                curl_setopt($ch, CURLOPT_URL, $sms['url']); 
                $this_header = array("content-type: application/x-www-form-urlencoded;charset=UTF-8");
                curl_setopt($ch, CURLOPT_HTTPHEADER, $this_header);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata); // Post提交的数据包,好像不起作用,need to do  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                $result = curl_exec($ch);
                curl_close($ch);
                break;
        }
        $arr = explode(",", $result, 2);
        $iReturnCode = abs($arr[0]);
        return $iReturnCode;
    }

    /**
     * 把yii ar findall 返回的数据对像转换成数组  
     * @param type $obj
     */
    public static function objtoarray($obj) {
        $res = array();
        if (is_array($obj) && !empty($obj)) {
            foreach ($obj as $key => $value) {
                $res[] = $value->attributes;
            }
        }
        return $res;
    }

    /**
     * yii 批量插入数据的方法
     */
    public static function insertSeveral($table, $array_columns) {
        $sql = '';
        $params = array();
        $i = 0;
        foreach ($array_columns as $columns) {
            $names = array();
            $placeholders = array_values($columns);
            $names = array_keys($columns);
            if (!$i) {
                $sql = 'INSERT INTO ' . Yii::app()->db->tablePrefix . $table
                        . ' (' . implode(', ', $names) . ') VALUES ('
                        . implode(', ', $placeholders) . ')';
            } else {
                $sql .= ',(' . implode(', ', $placeholders) . ')';
            }
            $i++;
        }
        return Yii::app()->db->createCommand($sql)->execute();
    }

    /**
     * 跳转url的方法
     * @param type $url
     * @param type $js
     */
    public static function redirect($url, $js = true) {
        if ($js === true) {
            echo '<script type="text/javascript">window.location.href="' . $url . '";</script>';
            exit;
        } else {
            header("location:" . $url);
        }
    }

    /**
     * 检查是否需要保存小记信息
     * @param type $noteinfo
     */
    public static function isNeedSaveNoteInfo($noteinfo) {
        if ($noteinfo['next_contact'] != '') {
            return true;
        }
        if ($noteinfo['cust_info'] != '') {
            return true;
        }
        if ($noteinfo['requirement'] != '') {
            return true;
        }
        if ($noteinfo['service'] != '') {
            return true;
        }
        if ($noteinfo['dissent'] != '') {
            return true;
        }
        if ($noteinfo['next_followup'] != '') {
            return true;
        }
        if ($noteinfo['memo'] != '') {
            return true;
        }
        if (intval($noteinfo['dial_id']) > 0) {
            return true;
        }
        if (intval($noteinfo['message_id']) > 0) {
            return true;
        }
        return false;
    }

    public static function addWhere($where, $flag = 0) {
        $whereStr = '';
        foreach ($where as $k => $v) {
            if ($v && !strpos($whereStr, 'where')) {
                if ($k == 'stime') {
                    $k = $flag ? 'di.dial_time' : 'f.acct_time';
                    $v = strtotime($v);
                    $whereStr .= " where $k>='$v' and";
                } elseif ($k == 'ftime') {
                    $k = $flag ? 'di.dial_time' : 'f.acct_time';
                    $v = strtotime($v);
                    $whereStr .= " where $k<='$v' and";
                } elseif ($k == 'dept') {
                    $k = 'u.dept_id';
                    $whereStr .= " where $k='$v' and";
                } elseif ($k == 'group') {
                    $k = 'u.group_id';
                    $whereStr .= " where $k='$v' and";
                } elseif ($k == 'users') {
                    $k = 'u.eno';
                    $whereStr .= " where $k='$v' and";
                }
            } elseif ($v && strpos($whereStr, 'where')) {
                if ($k == 'stime') {
                    $k = $flag ? 'di.dial_time' : 'f.acct_time';
                    $v = strtotime($v);
                    $whereStr .= " $k>='$v' and";
                } elseif ($k == 'ftime') {
                    $k = $flag ? 'di.dial_time' : 'f.acct_time';
                    $v = strtotime($v);
                    $whereStr .= " $k<='$v' and";
                } elseif ($k == 'dept') {
                    $k = 'u.dept_id';
                    $whereStr .= " $k='$v' and";
                } elseif ($k == 'group') {
                    $k = 'u.group_id';
                    $whereStr .= " $k='$v' and";
                } elseif ($k == 'users') {
                    $k = 'u.eno';
                    $whereStr .= " $k='$v' and";
                }
            }
        }
        $whereStr = $whereStr ? trim($whereStr, ' and') : '';
        return $whereStr;
    }

    public static function genUserCondition($user_arr) {
        $wherestr = "";
        if (empty($user_arr)) {
            return '';
        }
        $user_chunks = array_chunk($user_arr, 50);
        $wherestr = "";
        foreach ($user_chunks as $arr) {
            $instr = implode(",", $arr);
            $wherestr = $wherestr . " or id in( " . $instr . ")";
        }
        if (is_array($user_chunks) && count($user_chunks) > 0) {
            $wherestr = substr($wherestr, 3);
        }
        return $wherestr;
    }

    public static function genUserConditionForReport($user_arr) {
        $wherestr = "";
        if (empty($user_arr)) {
            return '';
        }
        $user_chunks = array_chunk($user_arr, 50);
        $wherestr = "";
        foreach ($user_chunks as $arr) {
            $instr = implode(",", $arr);
            $wherestr = $wherestr . " or u.id in( " . $instr . ")";
        }
        if (is_array($user_chunks) && count($user_chunks) > 0) {
            $wherestr = substr($wherestr, 3);
        }
        return $wherestr;
    }

    /**
     * 带序号将数组记录转成字符串
     * @param type $record
     * @return string
     */
    public static function array_to_string($keys, $record) {
        if (empty($record)) {
            return "";
        }
        $data = "";
        $i = 1;
        foreach ($keys as $k => $v) {
            if ($i == 1) {
                $data = $record[$v];
            } else {
                $data = $data . "," . $record[$v];
            }
            $i++;
        }
        $data = $data . "\n";
        return $data;
    }

    /**
     * 生成小记显示记录,need to do
     * @param type $record
     */
    public static function genNoteDisplayRecord($row, $record) {
        $str = ($row + 1) . "、" . date("Y-m-d H:i:s", $record->create_time) . " " . $record['cust_id'] . " " . Userinfo::getNameById($record['eno']) . " " . $record['cust_type'];
        $dial_detail = DialDetail::model()->findByPk($record['dial_id']);
        $custtype = CustType::findByTypeAndNo($record['lib_type'], $record['cust_type']);
        if ($record['dial_id'] > 0) {
            $str = $str . " 已拔打电话";
            if ($dial_detail['dial_long'] > 0) {
                $str = $str . " <a href='#' onclick='javascript:playAndDown()'>播放和下载</a>";
            }
        }
        $str = $str . "<br/>";

        $str = $str . $record['cust_type'] . ":" . $custtype['type_name'] . "->下次联系时间：" . date("Y-m-d H:i:s", $record->next_contact) . "<br/>";
        $str = $str . "电话接通状态->";
    }

    /**
     * 自定义每页显示的条数(下拉列表)
     */
    public static function selectPageSize() {
        $seletes = array(1 => 10, 2 => 50, 3 => 100, 4 => 200);
        return $seletes;
    }

    public static function listData($list, $valueField, $textField) {
        $arr = array();
        if (!empty($list)) {
            foreach ($list as $record) {
                echo $record[$textField];
                if(!empty($record[$valueField])&&!empty($record[$textField])){ 
                    $arr[]=array($record[$valueField]=>$record[$textField]);
                }
            }
        }
        return $arr;
    }

}
