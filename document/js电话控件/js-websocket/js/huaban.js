//huaban return value
var E9;
if(!E9) E9 = {}; //第一级域名     
E9.User = {}; //第二级域名 
E9.Session = {};//第二级域名
E9.Server = {}; //第二级域名
var a=new Object();
var b=new Object();
var huaba_rev_str ='';
var huaba_cur_operate ='';
var socket;
var cur_seatphone = '';
var cur_outphone = '';
var cur_orgid = 0;
var connected_ind = 0;
var call_state = 'idle';
var logining_flag = 0;
var switch_org_flag = 0;
var callCurTrans = 0;

//连接服务器
E9.Server.connect = function(){
	onConnect();
	}
//断开服务器连接
E9.Server.disconnect = function(){
	onDisconnect();
	}
//用户登录 
E9.User.login=function(loginname,password){     
 onLogin(loginname,password);   
}
//用户退出
E9.User.logout=function(){
	onLogout();
	}
	//新增接听话机
E9.User.addSeat=function(seatno){
	onAddSeat(seatno);
	}
	//删除接听话机
E9.User.deleteSeat=function(seatno){
	onDelSeat(seatno);
	}
	//切换接听话机
E9.User.switchSeat=function(seatno){
	onSwitchSeat(seatno);
	}
	//获取接听话机列表
E9.User.getSeatList=function(){
	onGetAllSeat();
	}
	//切换去电号码
E9.User.switchCallerID =function(outno){
	onSwitchOut(outno);
	}	
	//获取去电号码列表
E9.User.getCallerIDList =function(){
	 onGetAllOut();
	}	
	//发起呼叫
E9.Session.makeCall = function(seat,phone,outphone,billcallid){
	onCall(seat, phone, outphone, billcallid);
	}
	//停止呼叫
E9.Session.endCall = function(callid){
	onHookUser(callid);
	onHookUser();
	}	
E9.Session.processEvent = function (obj,fun){
	   fun(obj);
   	}

/****/
function onConnect()
{
	if (connected_ind != 0)
		return;
	try{
        socket=new WebSocket('ws://219.133.59.104:8031');
        connected_ind = 1;
    }catch(e){
        alert('您的浏览器不支持WebSocket。请选择其他的浏览器再尝试连接服务器。');
        return;
    }
    socket.onopen = sOpen;
    socket.onerror = sError;
    socket.onmessage = sMessage;
    socket.onclose = sClose;
}
function sOpen(){
	  a.cmd="connect";
	  a.ret="0";
	  E9.Session.processEvent(a,callback);
}
function sError(){
    var objDIV = document.getElementById("div0");
    var objDIV1 = document.getElementById("div01");
    var objDIV2 = document.getElementById("div02");
    objDIV.innerHTML = "<img  src=\"images/0.png\"/>&nbsp;<img  src=\"images/0.png\"/>&nbsp;<img  src=\"images/0.png\"/>";	
    objDIV1.innerHTML = "<img  src=\"images/0.png\"/>&nbsp;<img  src=\"images/0.png\"/>&nbsp;<img  src=\"images/0.png\"/>";	
    objDIV2.innerHTML = "<img  src=\"images/0.png\"/>&nbsp;<img  src=\"images/0.png\"/>&nbsp;<img  src=\"images/0.png\"/>";	
    connected_ind = 0;
    return;
}
function sMessage(msg){

//    alert('收到服务器信息:'+msg.data);
    var objs = JSON.parse(msg.data);
   	E9.Session.processEvent(objs,callback);
    parseObjLog(objs);
//    addTrace("recv: "+objs.cmd+", "+objs);
    if(objs.cmd == "evsys")
    {
    	if(objs.evno == 1000)
    	{
    		alert('用户在其他地方登录！');
    	}
    	else
//    	addTrace("recv:"+objs.cmd+", evno:"+Number(objs.evno)+", evmsg:"+objs.evmsg);
    	alert('cmd:'+objs.cmd+', evno:'+Number(objs.evno)+', evmsg:'+objs.evmsg);
    }
    else if(objs.cmd == "evbcall")
    {
    	parseStateLog(objs);
    	if(objs.evcode == 103)
    	{
    		document.getElementById("hujiaodiv").style.display = "";
			hujiaonum.innerHTML = objs.out;
			hujiaonum.innerHTML += "<br/>";
   			hujiaodesci.innerHTML = "来电";
//    		alert(objs.out+'来电, 呼叫'+objs.bcall);

			huchunum.innerHTML = objs.bcall;
	   		callCurTrans = 1;
			session_id = objs.callid;
    	}
    	else if(objs.evcode == 101)
    	{
    		hujiaodesci.innerHTML = "用户电话回铃";
    	}
    	else if(objs.evcode == 102)
    	{
    	
    		hujiaodesci.innerHTML = "用户电话应答";
    		if(callCurTrans == 1)
    		{
    			callCurTrans = 2;
    			$("callTransferDiv").style.display = "";
    		}
    		if(callCurTrans == 3)
    		{
    			callCurTrans = 0;
    			document.getElementById("callConfirmID").removeAttribute('disabled');
    		}
    	}
    	else if(objs.evcode == 201)
    	{	
    	}
    }
    else if(objs.cmd == "evacall")
    {
    	parseStateLog(objs);
    	if(objs.evcode == 103)
    	{
   			hujiaodesci.innerHTML = "呼叫";
    	}
    	else if(objs.evcode == 101)
    	{
    		hujiaodesci.innerHTML = "坐席电话回铃";
    	}
    	else if(objs.evcode == 102)
    	{
     
    		hujiaodesci.innerHTML = "坐席电话应答";
    	}
    	else if(objs.evcode == 201)
    	{
    	}
    }
    else
    {

    	if(objs.ret == 0)
    	{

    		if(objs.cmd == 'getallseat')
    		{
          onGetAllOut();
		    	var str_tmp = JSON.stringify(objs.list);
		    	var str_num = JSON.parse(str_tmp);
		    	var str_phone;
		    	while(str_num.length > 0)
		    	{	    		
		    		str_phone = str_num.pop();
		    
		    		if(str_num.length == 0)
		    		{
		    			//document.getElementById('jtdiv').innerHTML=str_phone;
					  }
				
		    	}
				if(switch_org_flag == 1)
				{
					switch_org_flag = 0;
					onGetAllOut();
				}
    		}
    		else if(objs.cmd == 'getallout')
			{
		    	var str_tmp = JSON.stringify(objs.list);
		    	var str_num = JSON.parse(str_tmp);
		    	var str_phone;
//		    	alert(str_num.length);
		    	while(str_num.length > 0)
		    	{
		    		str_phone = str_num.pop();
		    		if(str_phone.indexOf("77700003") >= 0)
		    			str_phone = "HIDE";
		    		if(str_num.length == 0)
		    		{
		    			//document.getElementById("202").innerHTML=str_phone;
					   }
		    	}
				
				if(switch_org_flag == 1)
				{
					switch_org_flag = 0;
					onGetAllSeat();
				}
			}
			else if(objs.cmd == 'dial')
			{
				session_id = objs.callid;
				if(session_id >= 0)
				{
					document.getElementById("hujiaodiv").style.display = "";
//					hujiaojnum.innerHTML = objs.bcall;
//					hujiaojnum.innerHTML += "<br/>";
//					$("hujiaodiv").style.display = "";
//	   	 		    $("hujiaojnum").innerHTML = objs.bcall;
	   	 		    return;
	   	 		}
	   	 		if (session_id == -1) {
                    alert("输入参数格式不对");
                }
                if (session_id == -2) {
                    alert("连接状态不对");
                }
			}
/*			else if(objs.cmd == 'hooka' || objs.cmd == 'hookb')
			{
				document.getElementById("hujiaodiv").style.display = "none";
			}*/
			else if(objs.cmd == 'login')
			{
		  //  handleBtnClick();
		    //	onGetOrgInfo();
			}
			else if(objs.cmd == 'logout')
			{
				logining_flag=0;
				onDisconnect();
			}
			else if(objs.cmd == 'state')
			{
			}
			else if(objs.cmd == 'getorginfo')
			{
				//div_orginfo_list.innerHTML = "";
		    	var innerStr;
		    	var str_tmp = JSON.stringify(objs.orginfo);
		    	var str_num = JSON.parse(str_tmp);
		    	var str_org;
		    	while(str_num.length > 0)
		    	{
		    		str_org = str_num.pop();
//					if(str_org.orgid == cur_orgid)
//						continue;
		    		innerStr = "<input type='radio' name='setcurorginfo' id='";
		    		innerStr += str_org.orgname;
					innerStr += "\' value=";
					innerStr += str_org.orgid;
					if(str_org.orgid == cur_orgid)
						innerStr += " checked/>";
					else
						innerStr += "/>";
					innerStr += str_org.orgname;
					innerStr +=	"<br/>";
					//div_orginfo_list.innerHTML += innerStr;
		    	}
				//div_orginfo_list.innerHTML += "<br/>";
			}
			else if(objs.cmd == 'switchorg')
			{
				switch_org_flag = 1;
				onGetAllSeat();
//				onGetAllOut();
			}
    	}
    }
    
    
    if(huaba_cur_operate == 'Login')
    {
//		var PhonesStr = eval("(" +evDescrible + ")");
		
//		document.getElementById("div2").style.display = "";
//		document.getElementById("div1").style.display = "none";
//		connected_ind = 3;
//		$("hujiaojnum").innerHTML = PhonesStr.seatphone;
	}
	else if(huaba_cur_operate == 'GetAllSeat')
	{
/*		div_seatphone_list.innerHTML = "";
		var SeatPhonesStr = eval("(" +evDescrible + ")");
		var strArray = SeatPhonesStr.phonelist.split("|");
		var innerStr;
		for (var i=0;i<strArray.length;i++)
		{
			innerStr = "<input type='radio' name='setcurseat' value='";
			innerStr+= strArray[i];
			if(strArray[i]==SeatPhonesStr.curphone)
				innerStr+= "\' checked/>";
			else
				innerStr+= "\'/>";
			innerStr+= strArray[i];
			innerStr+=	"<br/>";
			div_seatphone_list.innerHTML += innerStr;
		}
		div_seatphone_list.innerHTML += "<br/>";*/
	}
	else if(huaba_cur_operate == 'SwitchSeat')
	{
		var seatphonelist =  document.getElementsByName("setcurseat");
		var callphonenumber='1350000000';
		for(var i=0;i<seatphonelist.length;i++)
		{
			if(seatphonelist[i].checked==true)
			{
				callphonenumber = seatphonelist[i].value;
			}
		}
		hujiaojnum.innerHTML = callphonenumber;
	}
	
	else if(huaba_cur_operate == 'GetAllOut')
	{
/*		div_dispphone_list.innerHTML = "";
		var DispPhonesStr = eval("(" +evDescrible + ")");
		var strArray = DispPhonesStr.phonelist.split("|");
		var innerStr;
		for (var i=0;i<strArray.length;i++)
		{
			innerStr = "<input type='radio' name='setcurdisp' value='";
			innerStr+= strArray[i];
			if(strArray[i]==DispPhonesStr.curphone)
			innerStr+= "\' checked/>";
			else
				innerStr+= "\'/>";
			innerStr+= strArray[i];
			innerStr+=	"<br/>";
			div_dispphone_list.innerHTML += innerStr;
		}
		div_dispphone_list.innerHTML += "<br/>";*/
	} 
}
function sClose(){
    connected_ind = 0;
    return;
}

function onDisconnect()
{
	socket.close();
	b.cmd="disconnect";
	b.ret="0";
	E9.Session.processEvent(b,callback);
	connected_ind = 0;
}

function onLogin(loginname,password)
{
	var str;
	str = '{"cmd": "login", "acc": "'+loginname+'", "pass": "'+password+'"}';
	socket.send(str); 
	huaba_cur_operate = 'Login';
	//addTrace("send: "+'{"cmd": "login", "acc": "'+loginname+'", "pass": "******"}');
//	alert("Login");
}
function onLogout()
{
	var str;
	
	str = '{"cmd": "logout"}';
	socket.send(str);
	huaba_cur_operate = 'Logout';
	addTrace("send: "+str);
	if(connected_ind == 3)
		connected_ind = 2;
//	alert("Logout");
}
function onCall(seat, phone, outphone, billcallid)
{

	var str;
	if(outphone == 'HIDE')
		outphone = "";
	str = '{"cmd": "dial", "acall": "'+seat+'", "bcall": "'+phone+'", "out": "'+outphone+'", "bill": "'+billcallid+'"}';
	socket.send(str);
	huaba_cur_operate = 'Call';
	addTrace("send: "+str);
//	alert("Call");
}
function onHookUser(callid)
{
	var str;
	
	if(callid < 0)
	{
		return;
	}
	str = '{"cmd": "hookb", "callid": '+Number(callid)+'}';
	socket.send(str);
	huaba_cur_operate = 'HookUser';
	addTrace("send: "+str);
	callCurTrans = 0;
//	alert("HookUser");
}
function onHookSeat()
{
	var str;
	
	str = '{"cmd": "hooka"}';
	socket.send(str);
	huaba_cur_operate = 'HookSeat';
	addTrace("send: "+str);
//	alert("HookSeat");
}

function onAddSeat(seatno)
{
	var str;
	
	str = '{"cmd": "addseat", "seat": "'+seatno+'"}';
	socket.send(str);
	huaba_cur_operate = 'AddSeat';
	addTrace("send: "+str);
//	alert("AddSeat");
}
function onDelSeat(seatno)
{
	var str;
	
	str = '{"cmd": "delseat", "seat": "'+seatno+'"}';
	socket.send(str);
	huaba_cur_operate = 'DelSeat';
	addTrace("send: "+str);
//	alert("DelSeat");
}
function onSwitchSeat(seatno)
{
	var str;
	str = '{"cmd": "switchseat", "seat": "'+seatno+'"}';
	socket.send(str);
	huaba_cur_operate = 'SwitchSeat';
	cur_seatphone = seatno;
	addTrace("send: "+str);
//	alert("SwitchSeat");
}
function onGetAllSeat()
{
	//
	var str;
	str = '{"cmd": "getallseat"}'
	socket.send(str);

	huaba_cur_operate = 'GetAllSeat';
	addTrace("send: "+str);
	//alert("GetAllSeat");
}

function onSwitchOut(outno)
{
	var str;
//	alert(outno);
//	if(outno.indexOf("77700003") >= 0)
/*	if(outno == 'HIDE')
	{
		seatno = "075577700003";
	}*/
	str = '{"cmd": "switchout", "out": "'+outno+'"}';
	socket.send(str);
	huaba_cur_operate = 'SwitchOut';
	cur_outphone = outno;
	addTrace("send: "+str);
//	alert("SwitchOut");
}
function onGetAllOut()
{
	var str;
	
	str = '{"cmd": "getallout"}';
	socket.send(str);
	huaba_cur_operate = 'GetAllOut';
	addTrace("send: "+str);
//	alert("GetAllOut");
}

function onGetOrgInfo()
{
	var str;
	
	str = '{"cmd": "getorginfo"}';
	socket.send(str);
	huaba_cur_operate = 'GetOrgInfo';
	addTrace("send: "+str);
//	alert("GetOrgInfo");
}

function onSwitchOrgInfo(orgid)
{
	var str;

	str = '{"cmd": "switchorg", "orgid": '+orgid+'}';
	socket.send(str);
	huaba_cur_operate = 'SwitchOrg';
	cur_orgid = orgid;
	addTrace("send: "+str);
//	alert("SwitchOrg");
}

function onCallTrans(transPhone, transType)
{
	var str;

	str = '{"cmd": "calltrans", "transphone": "'+transPhone+'", "transtype": '+transType+'}';
	socket.send(str);
	huaba_cur_operate = 'CallTrans';
	addTrace("send: "+str);
//	alert("CallTrans");
}

function onDecideTrans(operType)
{
	var str;

	str = '{"cmd": "decidetrans", "opertype": '+operType+'}';
	socket.send(str);
	huaba_cur_operate = 'DecideTrans';
	addTrace("send: "+str);
//	alert("DecideTrans");
}

function onGetState()
{
//	socket.send('{"cmd": "state"}');
//	huaba_cur_operate = 'GetState';
	alert('connect state: '+Number(connected_ind));
}

function onGetCallLineState()
{
	alert('call state: '+call_state);
}

function parseStateLog(objs)
{
	var str = '';
	if(objs.cmd == 'evbcall')
	{
		str = 'user ';
	}
	else if(objs.cmd == 'evacall')
	{
		str = 'seat ';
	}
	if(objs.evcode == 101)
		call_state = str+'ring';
	else if(objs.evcode == 102)
		call_state = str+'answer';
	else if(objs.evcode == 103)
		call_state = str+objs.state;
	else if(objs.evcode == 201)
		call_state = str+'hook';
}

function parseObjLog(objs)
{
	var err_msg = '';	// err_msg, callres
	var list_num = '';
	var str_tmp = '';	// str_tmp, state
	var str_num = '';

	if(objs.cmd != 'evsys' && objs.cmd != 'evbcall' && objs.cmd != 'evacall' && objs.ret > 0)
		err_msg = ', "ermsg:"'+objs.ermsg+'"';
	if(objs.cmd == 'login')
	{
		if(objs.ret == 0)
			addTrace('recv: {"cmd":"'+objs.cmd+'", "ret":'+objs.ret+', "orgid":'+objs.orgid+', "orgname":"'+objs.orgname+'"}');
		else
			addTrace('recv: {"cmd":"'+objs.cmd+'", "ret":'+objs.ret+', "ermsg":"'+err_msg+'"}');
	}
	else if(objs.cmd == 'logout')
	{
		addTrace('recv: {"cmd":"'+objs.cmd+'", "ret":'+objs.ret+err_msg+'}');
	}
	else if(objs.cmd == 'dial')
	{
		addTrace('recv: {"cmd":"'+objs.cmd+'", "ret":'+objs.ret+', "callid":'+objs.callid+', "bcall":"'+objs.bcall+'"'+err_msg+'}');
	}
	else if(objs.cmd == 'hookb')
	{
		addTrace('recv: {"cmd":"'+objs.cmd+'", "ret":'+objs.ret+err_msg+'}');
	}
	else if(objs.cmd == 'hooka')
	{
		addTrace('recv: {"cmd":"'+objs.cmd+'", "ret":'+objs.ret+err_msg+'}');
	}
	else if(objs.cmd == 'addseat')
	{
		addTrace('recv: {"cmd":"'+objs.cmd+'", "ret":'+objs.ret+err_msg+'}');
	}
	else if(objs.cmd == 'delseat')
	{
		addTrace('recv: {"cmd":"'+objs.cmd+'", "ret":'+objs.ret+err_msg+'}');
	}
	else if(objs.cmd == 'switchseat')
	{
		addTrace('recv: {"cmd":"'+objs.cmd+'", "ret":'+objs.ret+err_msg+'}');
	}
	else if(objs.cmd == 'getallseat')
	{
		if(objs.ret == 0)
		{
			str_tmp = JSON.stringify(objs.list);
			str_num = JSON.parse(str_tmp);
			if(str_num.length > 0)
				list_num = ', "list":["'+str_num.pop();
			while(str_num.length > 0)
			{
				list_num += '", "'+str_num.pop();
			}
			list_num += '"]';
		}
		addTrace('recv: {"cmd":"'+objs.cmd+'", "ret":'+objs.ret+list_num+err_msg+'}');
	}
	else if(objs.cmd == 'switchout')
	{
		addTrace('recv: {"cmd":"'+objs.cmd+'", "ret":'+objs.ret+err_msg+'}');
	}
	else if(objs.cmd == 'getallout')
	{
		if(objs.ret == 0)
		{
			str_tmp = JSON.stringify(objs.list);
			str_num = JSON.parse(str_tmp);
			if(str_num.length > 0)
				list_num = ', "list":["'+str_num.pop();
			while(str_num.length > 0)
			{
				list_num += '", "'+str_num.pop();
			}
			list_num += '"]';
		}
		addTrace('recv: {"cmd":"'+objs.cmd+'", "ret":'+objs.ret+list_num+err_msg+'}');
	}
	else if(objs.cmd == 'getorginfo')
	{
		if(objs.ret == 0)
		{
			str_tmp = JSON.stringify(objs.orginfo);
			str_num = JSON.parse(str_tmp);
			var str_org = str_num.pop();
			if(str_num.length > 0)
				list_num = ', "orginfo":[{"orgid":'+str_org.orgid+',"orgname":"'+str_org.orgname;
			while(str_num.length > 0)
			{
				str_org = str_num.pop();
				list_num += '"}, {"orgid":'+str_org.orgid+',"orgname":"'+str_org.orgname;
			}
			list_num += '"}]';
		}
		addTrace('recv: {"cmd":"'+objs.cmd+'", "ret":'+objs.ret+list_num+err_msg+'}');
	}
	else if(objs.cmd == 'switchorg')
	{
		addTrace('recv: {"cmd":"'+objs.cmd+'", "ret":'+objs.ret+err_msg+'}');
	}
	else if(objs.cmd == 'evsys')
	{
		addTrace('recv: {"cmd":"'+objs.cmd+'", "evno":'+objs.evno+', "evmsg":"'+objs.evmsg+'"}');
	}
	else if(objs.cmd == 'evbcall')
	{
		if(objs.evcode == 103)		// include state
			str_tmp = ', "state":"'+objs.state+'"';
		else if(objs.evcode == 201)	//include callres
			err_msg = ', "callres":"'+objs.callres+'"';
		addTrace('recv: {"cmd":"'+objs.cmd+'", "callid":'+objs.callid+', "evcode":'+objs.evcode+str_tmp+err_msg+'}');
	}
	else if(objs.cmd == 'evacall')
	{
		if(objs.evcode == 103)		// include state
			str_tmp = ', "state":"'+objs.state+'"';
		else if(objs.evcode == 201)	//include callres
			err_msg = ', "callres":"'+objs.callres+'"';
		addTrace('recv: {"cmd":"'+objs.cmd+'", "evcode":'+objs.evcode+str_tmp+err_msg+'}');
	}
	else
	{
		addTrace('recv: {"cmd":"'+objs.cmd+'", "ret":'+objs.ret+err_msg+'}');
	}
}

