<?
/**
 * @功能: uncallcc API DEMO
 * @作者: 罗杰
 * @日期：2013 09 10
 */

//调试开关
//ini_set('display_errors', true);
//声明应引用地址
define('DIAL_SERVERES_ADDRESS_WSDL_API',"http://192.168.1.200/uncall_api/index.php?wsdl");
//实例化接口
$soapClient = new SoapClient(DIAL_SERVERES_ADDRESS_WSDL_API); //调用接口	
//接口调用
$reslut=$soapClient->OnClickCall("801","18681981812","");
var_dump($reslut);
echo "<test>";
?>