<?php
/*
 * 
 *	PHP POST提交UTF-8
 * 
 */
$url = "http://sms.10690221.com:9011/hy/";
$post_string = "uid=30032&auth=d36*********fae7e&mobile=15000184642&msg=".urlencode("尊敬的会员：您*******已申请展期9天，展期期间年化收益为17.38%25，展期期限以实际还款日期为准，感谢您的支持！")."&expid=0&encode=utf-8";
	$this_header = array("content-type: application/x-www-form-urlencoded;charset=UTF-8");
 	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $this_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    echo $data;
    curl_close($ch);
    return $data;
    
?>
