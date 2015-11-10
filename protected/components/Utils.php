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
        //return substr_replace($phone, '****', 3, 4);
        return $phone;
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
        $result = Utils::sendMessage($phone, $msg, $method);
        $xml = simplexml_load_string($result);
        $memo = "";
        $status = 0;
        if ($xml && ((string) $xml->message) == 'ok') {
            $memo = "发送成功";
        } else {
            $memo = $xml->message;
            $status = 1;
        }
        $message = new Message();
        $message->setAttribute('cust_id', $cust_id);
        $message->setAttribute('phone', $phone);
        $message->setAttribute('content', $msg);
        $message->setAttribute('creator', Yii::app()->user->id);
        $message->setAttribute('create_time', time());
        $message->setAttribute('status', $status);
        $message->setAttribute('memo', $memo);
        $message->save();
        $noteinfo = new NoteInfoP();
        $noteinfo->setAttribute("cust_id", $cust_id);
        $noteinfo->setAttribute("message_id", $message->id);
        $noteinfo->setAttribute("note_type", NoteInfoP::$NOTE_TYPE_SEND_MESSAGE);
        $noteinfo->setAttribute("memo", $msg);
        Utils::addNoteInfo($noteinfo);
        return $message;
    }

    public static function sendMessage($phone, $msg) {
        $sms = Yii::app()->params['SMS'];
        $content = $msg . $sms['signature'];
        $result = "";
        if (!empty($phone) && substr($phone, 0, 1) == "0") {
            $phone = substr($phone, 1);
        }
        $data = array(
            'action' => 'send',
            'userid' => $sms['uid'],
            'account' => $sms['account'],
            'password' => $sms['auth'],
            'mobile' => $phone,
            'content' => $content,
            'time' => '',
            'extno' => ''
        );
        return Utils::postSMS($sms['url'], $data);   //POST方式提交 
    }

    /**
     * 
     * @param type $url
     * @param type $data
     * @return 
     * <returnsms>
      <returnstatus>Success</returnstatus>
      <message>ok</message>
      <remainpoint>4977</remainpoint>
      <taskid>8236763</taskid>
      <successcounts>1</successcounts>
     * </returnsms>
     */
    private static function postSMS($url, $data = '') {
        $row = parse_url($url);
        $host = $row['host'];
        $port = isset($row['port']) ? $row['port'] : 80;
        $file = $row['path'];
        $post = "";
        while (list($k, $v) = each($data)) {
            $post .= rawurlencode($k) . "=" . rawurlencode($v) . "&"; //转URL标准码
        }
        $post = substr($post, 0, -1);
        $len = strlen($post);
        $fp = @fsockopen($host, $port, $errno, $errstr, 10);
        if (!$fp) {
            return "$errstr ($errno)\n";
        } else {
            $receive = '';
            $out = "POST $file HTTP/1.1\r\n";
            $out .= "Host: $host\r\n";
            $out .= "Content-type: application/x-www-form-urlencoded\r\n";
            $out .= "Connection: Close\r\n";
            $out .= "Content-Length: $len\r\n\r\n";
            $out .= $post;
            fwrite($fp, $out);
            while (!feof($fp)) {
                $receive .= fgets($fp, 128);
            }
            fclose($fp);
            $receive = explode("\r\n\r\n", $receive);
            unset($receive[0]);
            return implode("", $receive);
        }
    }

    public static function sendMessage3($phone, $msg, $method = 'get') {
        $sms = Yii::app()->params['SMS'];
        if (!empty($phone) && substr($phone, 0, 1) == "0") {
            $phone = substr($phone, 1);
        }
        $msg = $msg . $sms['signature'];
        try {
            $client = new soapclient($sms['url'], array('encoding' => 'utf-8'));
            $result = $client->Submit($sms['uid'], $sms['auth'], $sms['accessCode'], $msg, $phone);
            var_dump($result);
        } catch (SoapFault $fault) {
            echo "Error: ", $fault->faultcode, ", string: ", $fault->faultstring;
        }
    }

    /**
     * 发送短信
     * @param type $phone 电话号码
     * @param type $msg 短信内容
     * @param type $method get/post
     * @return type $iReturnCode 状态码
     */
    public static function sendMessage2($phone, $msg, $method = 'get') {
        $content = urlencode($msg);
        $sms = Yii::app()->params['SMS'];
        $result = "";
        if (!empty($phone) && substr($phone, 0, 1) == "0") {
            $phone = substr($phone, 1);
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
    public static function isNeedSaveNoteInfo($noteinfo, $custtype) {

        /* if ($noteinfo['cust_info'] != '') {
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
          } */
        if ($noteinfo['memo'] != '') {
            return true;
        }
        if (intval($noteinfo['dial_id']) > 0 && $custtype != 9) {
            return true;
        }
        if (intval($noteinfo['message_id']) > 0 && $custtype != 9) {
            return true;
        }
        if ($noteinfo['next_contact'] != '') {
            return true;
        }
        return false;
    }

    /**
     * 检查是否需要保存小记信息
     * @param type $noteinfo
     */
    public static function isNeedSaveNoteInfoForAfter($noteinfo, $custtype) {

        /* i if ($noteinfo['cust_info'] != '') {
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
          } */
        if ($noteinfo['memo'] != '') {
            return true;
        }
        if (intval($noteinfo['dial_id']) > 0 && $custtype != 8) {
            return true;
        }
        if (intval($noteinfo['message_id']) > 0 && $custtype != 8) {
            return true;
        }
        if ($noteinfo['next_contact'] != '') {
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
    public static function genNoteDisplayRecord($record) {
        $notetype = $record['note_type'];
        $notedesc = "添加了跟进记录";
        switch ($notetype) {
            case 1:$notedesc = "新增了客户";
                break;
            case 2:$notedesc = "拔打对方电话";
                break;
            case 3:$notedesc = "放入公海";
                break;
            case 4:$notedesc = "从公海获取";
                break;
            case 5:$notedesc = "发送短信";
                break;
        }
        $str = '<font style="font-weight:bold">' . Userinfo::getNameById($record['userid']) . "</font>&nbsp;&nbsp;&nbsp;<font color='gray'>" . date("Y-m-d H:i:s", $record->create_time) . " $notedesc </font><br/><br/> ";
        $str = $str . " " . $record['memo'] . " ";
        if ($notetype == 0) {
            $custtype = CustType::findByTypeAndNo($record['lib_type'], $record['cust_type']);
            $str = $str . " ";
            $str = $str . "<br/><font color='green'>【" . $record['cust_type'] . " 类 - " . $custtype['type_name'] . "】&nbsp;&nbsp;->&nbsp;下次联系时间：";
            if ($record->next_contact) {
                $str = $str . date("Y-m-d H:i:s", $record->next_contact);
            }
            $str = $str . "</font>";
        } 
        return $str;
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
                if (!empty($record[$valueField]) && !empty($record[$textField])) {
                    $arr[] = array($record[$valueField] => $record[$textField]);
                }
            }
        }
        return $arr;
    }

    public static function paraseSeconds($seconds) {
        $time = "00:00:00";
        if ($seconds > 0) {
            $second = $seconds % 60;
            $minute = intval(($seconds - $second) / 60);
            $hour = 0;
            if ($minute > 60) {
                $hour = intval($minute / 60);
                $minute = $minute % 60;
            }
            if ($hour < 10) {
                $time = "0" . $hour . ":";
            } else {
                $time = $hour . ":";
            }
            if ($minute < 10) {
                $time = $time . "0" . $minute . ":";
            } else {
                $time = $time . $minute . ":";
            }
            if ($second < 10) {
                $time = $time . "0" . $second;
            } else {
                $time = $time . $second;
            }
        }
        return $time;
    }

    public static function parseText($text) {
        $str = str_replace(chr(13), "<br>", $text);
        $str = str_replace(chr(10), "<br>", $text);
        return $str;
    }

    public static function addNoteInfo($noteinfo) {
        $noteinfo->setAttribute("isvalid", 1);
        $noteinfo->setAttribute("dial_id", 0);
        $noteinfo->setAttribute("iskey", 0);
        if (empty($noteinfo->message_id)) {
            $noteinfo->setAttribute("message_id", 0);
        }
        $noteinfo->setAttribute("next_contact", '0');
        $noteinfo->setAttribute("userid", Yii::app()->user->id);
        $noteinfo->setAttribute("lib_type", 99);
        $noteinfo->setAttribute("cust_type", '99');
        $noteinfo->setAttribute("create_time", time());
        Yii::app()->db->createCommand("update {{seq_note_id}} set seq=seq+1 where 1=1")->execute();
        $seqnoteid = SeqNoteId::model()->findBySql("select seq from {{seq_note_id}} where 1=1 limit 1");
        $noteinfo->id = $seqnoteid->seq;
        $noteinfo->save();
    }

}
