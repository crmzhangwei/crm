<?php

/**
 *  PublicTool.php 常用工具类
 */
class PulicTool {

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

    public static function truncate_utf8_string($string, $length, $etc = '...') {
        $result = '';
        $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
        $strlen = strlen($string);
        for ($i = 0; (($i < $strlen) && ($length > 0)); $i++) {
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0')) {
                if ($length < 1.0) {
                    break;
                }
                $result .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            } else {
                $result .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
        if ($i < $strlen) {
            $result .= $etc;
        }
        return $result;
    }

    public static function redirect($url, $js = true) {
        if ($js === true) {
            echo '<script type="text/javascript">window.location.href="' . $url . '";</script>';
            exit;
        } else {
            header("location:" . $url);
        }
    }

    /**
     * 生成随机数
     * @param type $len
     * @return type
     */
    public static function randString($len=6) {
        $str = '';
        for ($i = 1; $i <= $len; $i++) {
            $str.= rand(0, 9);
        }
        return $str;
    }
    
    /**
     * 验证手机号码
     * @param type $mobile
     * @return boolean
     */
    function checkMobile($mobile) {
        $exp = "/^13[0-9]{1}[0-9]{8}$|15[012356789]{1}[0-9]{8}$|18[012356789]{1}[0-9]{8}$|14[57]{1}[0-9]$|17[0]{1}[0-9]$/";
        if (preg_match($exp, $mobile)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 计算时间
     * @param int $time
     * @return string
     */
    public static function tranTime($time) {
        $t = time() - $time;
        $f = array(
            '31536000' => '年',
            '2592000' => '个月',
            '604800' => '星期',
            '86400' => '天',
            '3600' => '小时',
            '60' => '分钟',
            '1' => '秒'
        );
        foreach ($f as $k => $v) {
            if (0 != $c = floor($t / (int) $k)) {
                return $c . $v . '前';
            }
        }
    }

   
    /**
     * 根据IP获取城市地址
     * @param string $ip
     * @return string
     */
    public static function getAddressByIp($ip = '') {
        if (!preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/', $ip)) {
            return false;
        }
        if ($fd = @fopen(GB_DIR . '/QQWry.Dat', 'rb')) {
            $ip = explode('.', $ip);
            $ipNum = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3];
            $DataBegin = fread($fd, 4);
            $DataEnd = fread($fd, 4);
            $ipbegin = implode('', unpack('L', $DataBegin));

            if ($ipbegin < 0) {
                $ipbegin += pow(2, 32);
            }
            $ipend = implode('', unpack('L', $DataEnd));
            if ($ipend < 0) {
                $ipend += pow(2, 32);
            }
            $ipAllNum = ($ipend - $ipbegin) / 7 + 1;
            $BeginNum = 0;
            $EndNum = $ipAllNum;
            $ip1num = '';
            $ip2num = '';
            $ipAddr1 = '';
            $ipAddr2 = '';

            while ($ip1num > $ipNum || $ip2num < $ipNum) {
                $Middle = intval(($EndNum + $BeginNum) / 2);

                fseek($fd, $ipbegin + 7 * $Middle);
                $ipData1 = fread($fd, 4);
                if (strlen($ipData1) < 4) {
                    fclose($fd);
                    return 'System Error';
                }

                $ip1num = implode('', unpack('L', $ipData1));
                if ($ip1num < 0) {
                    $ip1num += pow(2, 32);
                }

                if ($ip1num > $ipNum) {
                    $EndNum = $Middle;
                    continue;
                }

                $DataSeek = fread($fd, 3);
                if (strlen($DataSeek) < 3) {
                    fclose($fd);
                    return 'System Error';
                }

                $DataSeek = implode('', unpack('L', $DataSeek . chr(0)));
                fseek($fd, $DataSeek);
                $ipData2 = fread($fd, 4);
                if (strlen($ipData2) < 4) {
                    fclose($fd);
                    return 'System Error';
                }

                $ip2num = implode('', unpack('L', $ipData2));
                if ($ip2num < 0) {
                    $ip2num += pow(2, 32);
                }
                if ($ip2num < $ipNum) {
                    if ($Middle == $BeginNum) {
                        fclose($fd);
                        return 'Unknown';
                    }
                    $BeginNum = $Middle;
                }
            }

            $ipFlag = fread($fd, 1);
            if ($ipFlag == chr(1)) {
                $ipSeek = fread($fd, 3);
                if (strlen($ipSeek) < 3) {
                    fclose($fd);
                    return 'System Error';
                }
                $ipSeek = implode('', unpack('L', $ipSeek . chr(0)));
                fseek($fd, $ipSeek);
                $ipFlag = fread($fd, 1);
            }

            if ($ipFlag == chr(2)) {
                $AddrSeek = fread($fd, 3);
                if (strlen($AddrSeek) < 3) {
                    fclose($fd);
                    return 'System Error';
                }
                $ipFlag = fread($fd, 1);

                if ($ipFlag == chr(2)) {
                    $AddrSeek2 = fread($fd, 3);
                    if (strlen($AddrSeek2) < 3) {
                        fclose($fd);
                        return 'System Error';
                    }
                    $AddrSeek2 = implode('', unpack('L', $AddrSeek2 . chr(0)));
                    fseek($fd, $AddrSeek2);
                } else {
                    fseek($fd, -1, SEEK_CUR);
                }

                while (($char = fread($fd, 1)) != chr(0)) {
                    $ipAddr2 .= $char;
                }

                $AddrSeek = implode('', unpack('L', $AddrSeek . chr(0)));
                fseek($fd, $AddrSeek);

                while (($char = fread($fd, 1)) != chr(0)) {
                    $ipAddr1 .= $char;
                }
            } else {
                fseek($fd, -1, SEEK_CUR);
                while (($char = fread($fd, 1)) != chr(0)) {
                    $ipAddr1 .= $char;
                }

                $ipFlag = fread($fd, 1);
                if ($ipFlag == chr(2)) {
                    $AddrSeek2 = fread($fd, 3);
                    if (strlen($AddrSeek2) < 3) {
                        fclose($fd);
                        return 'System Error';
                    }
                    $AddrSeek2 = implode('', unpack('L', $AddrSeek2 . chr(0)));
                    fseek($fd, $AddrSeek2);
                } else {
                    fseek($fd, -1, SEEK_CUR);
                }
                while (($char = fread($fd, 1)) != chr(0)) {
                    $ipAddr2 .= $char;
                }
            }


            fclose($fd);
            if (preg_match('/http/i', $ipAddr2)) {
                $ipAddr2 = '';
            }

            $ipaddr = "$ipAddr1 $ipAddr2";
            $ipaddr = preg_replace('/CZ88\.NET/is', '', $ipaddr);
            $ipaddr = preg_replace('/^\s*/is', '', $ipaddr);
            $ipaddr = preg_replace('/\s*$/is', '', $ipaddr);
            if (preg_match('/http/i', $ipaddr) || $ipaddr == '') {
                $ipaddr = 'Unknown';
            }
            return iconv('GBK', 'UTF-8', $ipaddr);
        }
    }

    /**
     * 隐藏电话号码
     * @param string $phone
     * @param int    $len
     * @return string
     */
    public static function hidePhone($phone = '', $len = 5) {
        $phone = trim($phone);
        if (strlen($phone) < 1) {
            return $phone;
        }
        return substr($phone, 0, $len) . '...';
    }
    
    //只保留中文，英文，数字
	static public function holdCN($str){
		return preg_replace('/[^\x{4e00}-\x{9fa5}|\x{0030}-\x{0039}|\x{0041}-\x{005a}|\x{0061}-\x{007a}]/u','',$str);
	}



	/*xml对象转换成数组*/
	static function objectToArray(&$object){
		$object = (array)$object;
	 	foreach ($object as $key => $value) {
	 		if (is_object($value)||is_array($value)) {
	 			self::objectToArray($value);
	 			$object[$key] = $value;
	 		}
	 	}
	}

	/**
	*	保留2位小数并四舍五入
	* 	@param $num 要转换的数字 $digit 保留的位数
	* */
	static function formatnum($num,$digit){
	 	$digit='%.'.$digit.'f';
	 	return sprintf($digit, $num);
	}
	
	/**
	*	判断数组中的最大值
	* 	@param $array 需判断的数组
	* */
	static function maxnum($array){
		foreach($array as $k=>$v){
				if( $k== 0 ){
 				 $max = $v;
			  }else{
				  $max = max($max,$v);
			  }
		}
			return $max;
	}
	
	/**
	*	判断$cTime是否合法
	* 	@param $cTime 需要判断的时间戳
	*	@param $sTime 开始时间戳
	*	@param $eTime 结束时间戳
	*	@return 0/1/2 未达到时间上限/时间合法/超出时间下限
	* */
	static function checkTime($cTime,$sTime,$eTime)
	{
		if($cTime<$sTime)
		{
			return 0;
		}elseif ($cTime>$eTime)
		{
			return 2;
		}else {
			return 1;
		}
	}
	 /*
         * 验证一个时间是否在某个区间内 三个时间的格式都为 date 格式，eg.  2013-08-19
         * @param       $pretime        需要被验证的时间
         * @param       $begintime      时间开始点
         * @param       $endtime        时间结束点
         * @return      0/1/2           未达到时间上限/时间合法/超出时间下限
         */
        public static function hasInSomeTimes($pretime,$begintime,$endtime){
            $cTime = strtotime($pretime);
            $sTime = strtotime($begintime);
            $eTime = strtotime($endtime);
            if($eTime<$sTime){
                $temp = $sTime;
                $sTime = $eTime;
                $eTime = $temp;
            }
            $res = self::checkTime($cTime, $sTime, $eTime);
            return $res;
            
        }
	/**
	*	格式化倒计时格式
	*	@param $t 格式化的时间(秒)
	*	@param $format 格式化的格式 default h:m:s;
	* */
	static function formatTime($t,$format='h:m:s')
	{
		$format = strtolower($format);
		$h = floor($t/3600);
		$h = $h<10?'0'.$h:$h;
		$m = floor($t%3600/60);
		$m = $m<10?'0'.$m:$m;
		$s = $t%3600%60;
		$s = $s<10?'0'.$s:$s;
		
		$format = str_replace(array('h','m','s'),array($h,$m,$s),$format);
		return $format;
	}
	
	/**
	 * 格式化时间为天
	 *
	 * @param int $t
	 */
	static function formatDay($t)
	{
		$d = floor($t/86400);
		return $d;
	}
	
	/**
    * 格式化一维数组为字符串
    *
    * @param     array   $array          一维数组
    * @param     string  $flag           分隔符,默认',';
    * @return    string
    */
   static function changeArrToStr($array,$flag=',')
   {
       return empty($array)?'':implode($flag,$array);
   }
   
   /**
    * 格式化字符串为一维数组
    *
    * @param     string       $str           要转化为数组的字符串
    * @return    array
    */
   static function changeStrToArr($str,$flag = ',')
   {
       return empty($str)?array():explode($flag,$str);
   }
   
   /**
    * 重组数据库返回结构
    *
    * @param array $res
    * @param string $key
    * @param bool $merge
    * @return array 返回重组的数组,若有异常则返回false
    */
   static function fetchAll($res,$key=null,$merge=false)
	{
		if(!(isset($res) && is_array($res))) return false;
		$result = array();
		
		foreach ($res as $k=>$row)
		{
			if($key && $merge==false) $result[$row[$key]]=$row;
			elseif($key && $merge===true)  $result[$row[$key]][] = $row;
			elseif($key && $merge)  $result[$row[$key]][$row[$merge]] = $row;
			else $result[]=$row;
		}
		return $result;
	}
	
	/**
	 * 检查两个时间区间是否重合
	 *
	 * @param int $sTime  第一个时间区间的开始时间戳
	 * @param int $eTime  第一个时间区间的结束时间戳
	 * @param int $sTime1 第二个时间区间的开始时间戳
	 * @param int $eTime1 第二个时间区间的结束时间戳
	 * 
	 * @return bool
	 */
	static function checkTimeRegion($sTime,$eTime,$sTime1,$eTime1)
	{
		$min = min($sTime,$sTime1);
		$max = max($eTime,$eTime1);
		$maxRegion = $max-$min;
		
		return $maxRegion-abs($sTime-$sTime1)-abs($eTime-$eTime1)>=0;
	}
	
	/**
	 * 根据条件在数据中来搜查项目,若无匹配则返回空数据
	 *
	 * @param array  $source    要进行搜查的数组
	 * @param string $filterKey 需要检查的键
	 * @param string $contrast  比较方式.如:>,<,=,in,!=,>=,<=,between
	 * @param array  $section   需要检查的值
	 * 							当比较方式为
	 *                          in:$section[0]是否在内$filterVal
	 *                          between:$filterVal是否在$section[0]和$section[1]内
	 * 							如果为其他则跟$section[0]进行比较
	 * 
	 * @return array 
	 */
	static function searchItem($source,$filterKey,$contrast,$section)
	{
		if (is_array($source) && !empty($source))
		{
			$result = array();
			foreach ($source as $key=>$value)
			{
				if ($contrast == ">")
				{
					if ($value[$filterKey] > $section[0])
					{
						$result[$key] = $value;
					}
				}elseif ($contrast == "<")
				{
					if ($value[$filterKey] < $section[0])
					{
						$result[$key] = $value;
					}
				}elseif ($contrast == "=")
				{
					if ($value[$filterKey] == $section[0])
					{
						$result[$key] = $value;
					}
				}elseif ($contrast == "in")
				{
					if (in_array($section[0],explode(",","$value[$filterKey]")))
					{
						$result[$key] = $value;
					}
				}elseif ($contrast == "!=")
				{
					if ($value[$filterKey] != $section[0])
					{
						$result[$key] = $value;
					}
				}elseif ($contrast == ">=")
				{
					if ($value[$filterKey] >= $section[0])
					{
						$result[$key] = $value;
					}
				}elseif ($contrast == "<=")
				{
					if ($value[$filterKey] <= $section[0])
					{
						$result[$key] = $value;
					}
				}elseif ($contrast == "between")
				{
					if(is_numeric($value[$filterKey]))
					{
						if($value[$filterKey] >= $section[0] && $value[$filterKey] <= $section[1])
						{
							$result[$key] = $value;
						}
					}else 
					{
						if(strtotime($value[$filterKey]) >= strtotime($section[0]) && strtotime($value[$filterKey]) <= strtotime($section[1]))
						{
							$result[$key] = $value;
						}
					}
				}
			}
			return $result;
		}else 
		{
			return $source;
		}
	}
	
	/**
 * @package     二维数组排序
 *
 *
 * @param  array   $ArrayData   需要排序数组.
 * @param  string  $KeyName1    需要排序的字段.
 * @param  string  $SortOrder1  排序方式(SORT_ASC|SORT_DESC)
 * @param  string  $SortType1   排序类型(SORT_REGULAR|SORT_NUMERIC|SORT_STRING)
 * @return array                
 */
	static function sysSortArray($ArrayData,$KeyName1,$SortOrder1 = "SORT_ASC",$SortType1 = "SORT_REGULAR")
	{
	    if(!is_array($ArrayData))
	    {
	        return $ArrayData;
	    }
	    // Get args number.
	    $ArgCount = func_num_args();
	
	    // Get keys to sort by and put them to SortRule array.
	    for($I = 1;$I < $ArgCount;$I ++)
	    {
	        $Arg = func_get_arg($I);
	        if(@!eregi("SORT",$Arg))
	        {
	            $KeyNameList[] = $Arg;
	            $SortRule[]    = '$'.$Arg;
	        }
	        else
	        {
	            $SortRule[]    = $Arg;
	        }
	    }
	 
	    // Get the values according to the keys and put them to array.
	    foreach($ArrayData AS $Key => $Info)
	    {
	        foreach($KeyNameList AS $KeyName)
	        {
	            ${$KeyName}[$Key] = $Info[$KeyName];
	        }
	    }
	 
	    // Create the eval string and eval it.
	    $EvalString = 'array_multisort('.join(",",$SortRule).',$ArrayData);';
	    eval ($EvalString);
	    return $ArrayData;
	}
	
	/**
	 * 去除字符的前后以及中间连续逗号
	 *
	 * @param string $str 需要去除前后以及中间连续逗号的字符串
	 * @return string
	 */
	static function removeDot($str)
	{
		return preg_replace('/^,+|,+$|(,+)\1/',"$1",$str);
	}
	
	

	/**
	 * 写入文件
	 *
	 * @param string $path
	 * @param string $filename
	 * @param string $content
	 * @param int $mode
	 * @return boolean
	 */
	static function createFile($path,$filename,$content,$mode = 0777)
	{
		if (!file_exists($path))
		{
			@mkdir($path,$mode);
			@chmod($path,$mode);
		}
		if (!file_exists($path.$filename))
		{
			$handle = fopen($path.$filename,"w+");
			fclose($handle);
		}
		return file_put_contents($path.$filename,$content,FILE_APPEND);
	}
       /*
        * 载取字符串
        * @param    $string     字符串
        * @param    $length     需要载取的长度
        * @param    $dot        多于的字符表示的符号‘...’
        */ 
       static function str_cut($string, $length, $dot = '...') {
	$strlen = strlen($string);
	if($strlen <= $length) return $string;
	$string = str_replace(array( '','&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array('∵',' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $string);
	$strcut = '';
	if(strtolower(CHARSET) == 'utf-8') {
		$length = intval($length-strlen($dot)-$length/3);
		$n = $tn = $noc = 0;
		while($n < strlen($string)) {
			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t <= 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}
			if($noc >= $length) {
				break;
			}
		}
		if($noc > $length) {
			$n -= $tn;
		}
		$strcut = substr($string, 0, $n);
		$strcut = str_replace(array('∵', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), array(' ', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), $strcut);
	} else {
		$dotlen = strlen($dot);
		$maxi = $length - $dotlen - 1;
		$current_str = '';
		$search_arr = array('&',' ', '"', "'", '“', '”', '—', '<', '>', '·', '…','∵');
		$replace_arr = array('&amp;','&nbsp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;',' ');
		$search_flip = array_flip($search_arr);
		for ($i = 0; $i < $maxi; $i++) {
			$current_str = ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
			if (in_array($current_str, $search_arr)) {
				$key = $search_flip[$current_str];
				$current_str = str_replace($search_arr[$key], $replace_arr[$key], $current_str);
			}
			$strcut .= $current_str;
		}
	}
	return $strcut.$dot;
    }
    /*
     * 获取某个时间的指定日期   例如+12    就是12天以后的日期   -12 就是12天以前的时间
     * param    str     $date   指定的时间
     * param    $int    $day    距离的天数
     * param    str     $type   normal|china|dot|slant 可选的参数
     * return   str
     */
    static function formatDateAndday($date,$day=0,$type='normal'){
        $time = strtotime($date);
        $types = array('normal','china','dot','slant');
        if(in_array($type, $types)){
            switch ($type) {
                case 'dot':
                    $type = 'Y.m.d';
                    break;
                case 'china':
                    $type = 'Y年m月d日';
                    break;
                case 'slant':
                    $type = 'Y/m/d';
                    break;
                default:
                    $type = 'Y-m-d';
                    break;
            }
        }
        $resdate = date($type,$time+$day*24*60*60);
        return $resdate;
        
    }
    
    /**
     *获得两个正数的最大公约数
     * 
     * @param    int		$a			正数
     * @param    int		$b			正数
     * @return 	 int	          
     */
    static function max_divisor($a, $b) 
    { 
         $n = min($a, $b); 
         for($i=$n; $i>1; $i--) 
         { 
             if (is_int($a/$i) && is_int($b/$i)) 
             { 
                 return $i; 
             } 
         } 
         return 1; 
    } 
    
    /**
     * 生成指定长度的随机数
     * @access   public
     * @param    $length               int
     * @param    $max                  int
     * @return   string
     * @author   NERO
     */
    static function random($length = 14,$max=FALSE)
    {
        if (is_int($max) && $max > $length){
            $length = mt_rand($length, $max);
        }
        $output = '';
        for ($i=0; $i<$length; $i++){
            $which = mt_rand(0,2);
            if ($which === 0){
              $output .= mt_rand(0,9);
            }elseif ($which === 1){
              $output .= chr(mt_rand(65,90));
            }else{
              $output .= chr(mt_rand(97,122));
            }
        }
        return $output;
   }
   
   /**
    * 格式化字符串
    *
    * @param string $format
    * @param array|string $vals
    * @return string
    */
	static function string_format($format,$vals)
	{
		$format=iconv("gb2312","utf-8",$format);
		if(!is_array($format)&& !isset($vals)){
			return $format;
		}
		if(!is_array($vals))
			$vals=array($vals);
	
		$result = $format;
		for($i=0;$i<count($vals);$i++)
			$result = str_replace(join("",array("{",$i,"}")),$vals[$i],$result); 
		return $result;
	}
	
	/**
	 * 使用 GET 方式发起一个 HTTP 请求, 并返回结果
	 *
	 * @param string $url
	 * @param array $keys
	 * @param array $vals
	 * @return mixed
	 */
	static function httpGet($url,$keys,$vals)
	{
		if(!is_array($keys)||!is_array($vals))return;
		if(count($keys)!=count($vals))return;
		$query = array();
		for($i=0;$i<count($keys);$i++)
			array_push($query, join("=", array($keys[$i], urlencode(  $vals[$i]) )   ));
		$httpQuery = join("",array($url,"?", join("&", $query)));
		// 1. 初始化 CURL
		$ch = curl_init();
		// 2. 设置选项，包括URL
		curl_setopt($ch, CURLOPT_URL, $httpQuery);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		// 3. 执行并获取HTML文档内容
		$output = curl_exec($ch);
		// 4. 释放curl句柄
		curl_close($ch);
		return $output;
	}
}       
?>
}
?>