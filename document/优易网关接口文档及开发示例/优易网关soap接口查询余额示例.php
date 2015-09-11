<?php
/*----------------------------------------------------------------------------
功能:soap协议接口 优易网关发送短信

请求地址 : http://113.105.65.138:7801/sms?wsdl

短信提交：；
String Submit("spID","password","accessCode","content","mobileString")

参数				类型		备注	
spID				String		账户ID	
password			String		账户密码	
accessCode			String		下发号码	最大长度19位
content				String		下发内容	最大长度67*4字，计费方式按单条最长70节，大于70字按67字计
mobileString		String		号码列表	最大号码个数10000，号码之间以英文逗号分割，如：1380000001, 1380000002
返回				String		提交返回结果	提交返回结果参见备注

返回值
如果RESULTCODE返回成功0,则从第二行开始，按提交的号码依次返回每个号码的提交状态和消息ID，用于状态报告的匹配；且返回当前账户余额BALANCE,单位厘

如果RESULTCODE不为0，则Balance返回0

RESULTCODE#@#BALANCE#@#
MID1#@#MOBILE1#@# RESULTCODE
MID2#@#MOBILE2#@# RESULTCODE
MIDn#@#MOBILEn#@# RESULTCODE

如果RESULTCODE返回成功0,则从第二行开始，返回状态和上行记录；且返回当前账户余额Balance,单位厘
如果RESULTCODE不为0，则余额返回0

RESULTCODE #@#BALANCE#@#
RDFLAG#@#MID#@#SPID#@#ACCESSCODE#@#MOBILE#@#STAT#@#DELIVERTIME#@#        RDFLAG#@#MID#@#SPID#@#ACCESSCODE#@#MOBILE#@#MSGCONTENT#@#DELIVERTIME#@#

RDFLAG:0=用户上行数据；1=号码状态报告；
MID：消息ID，如果 RDFLAG=1时，MID 与提交时返回的MID一致
ACCESSCODE：下发号码或上行时的目的号码
MOBILE：手机号
STAT：状态码，与CMPP2.0中REPORT的 状态码一致，当STAT=DELIVRD时候，表示消息投递成功
MSGCONTENT：用户上行内容
DELIVERTIME：报告或者上行接收时间

RESULTCODE定义
OK = 0,//成功
CON_BAD_PDU = 1, //错误的PDU
CON_INVALID_IP = 2,//IP鉴权错误
CON_INVALID_AUTH = 3,//鉴权错误
CON_BAD_VERSION = 4,//版本号错误
CONN_OTHER = 5,
CON_TOO_MANY_CONNECTIONS = 21,//连接过多
SYS_INTERNAL_ERROR = 100,//网关内部错误
SMT_INVALID_DEST_COUNT = 102, //号码数错误
SMT_BAD_CMD = 2,    //错误命令码
SMT_BAD_SEQ = 3,    //错误的时序
SMT_BAD_CONTENTLENGTH = 4,  //错误的内容长度
SMT_BAD_FEECODE = 5,//资费代码错误
SMT_BAD_MSGLENGTH = 6,//错误的消息长度
SMT_BAD_SERVICETYPE = 7,//错误的服务代码
SMT_FLUX_EXCEEDED = 8,//流量错误
SMT_BAD_SRCID = 10,//原发号码错误
SMT_BAD_DESTID = 12,//错误的目的号码
SMT_IB = 15,    //余额不足（资费代码错）
SMT_TIME_FORBIDDEN = 16 //时间禁止

-----------------------------------------------------------------------*/

$spID='000005';			//请根据自己的账户修改
$password = '123456';	//请根据自己的账户修改	


//如果使用php5版本以上的soap功能，需要再php.ini中开启php_soap扩展
try {
    $client=new soapclient('http://113.105.65.138:7801/sms?WSDL',array('encoding'=>'utf-8'));
	//如果出现乱码，修改后面的编码格式即可
 	echo $client->QueryMo($spID,$password);

} catch (SoapFault $fault){
    echo "Error: ",$fault->faultcode,", string: ",$fault->faultstring;
}



?>