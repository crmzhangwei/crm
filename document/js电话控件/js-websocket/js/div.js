var session_id = -1;
var intStartTime;
var arrDelays = [];
var intSent;
var bolIsRunning = false;
var bolIsTimeout;
var intTimeout;
var intTimerID;
var _reg = /^\s*$/;
var strURL = "219.133.59.104:8031";

  function connect() 
{
   E9.Server.connect();
}

  function disconnect() 
{
  	var objDIV = document.getElementById("div0");
    var objDIV1 = document.getElementById("div01");
    var objDIV2 = document.getElementById("div02");
    objDIV.innerHTML = "<img  src=\"images/2.png\"/>&nbsp;<img  src=\"images/2.png\"/>&nbsp;<img  src=\"images/2.png\"/>";
    objDIV1.innerHTML = "<img  src=\"images/2.png\"/>&nbsp;<img  src=\"images/2.png\"/>&nbsp;<img  src=\"images/2.png\"/>";
    objDIV2.innerHTML = "<img  src=\"images/2.png\"/>&nbsp;<img  src=\"images/2.png\"/>&nbsp;<img  src=\"images/2.png\"/>";
  	E9.Server.disconnect();
}
  
function resetUser(txtBox) 
{
		if (txtBox.value == "请输入电话号码") {
			txtBox.value = "";
			txtBox.style.color = "";
		} else if (_reg.test(txtBox.value)) {
			txtBox.value = "请输入电话号码"
			txtBox.style.color = "gray";
		}
}
 	
  function logout() 
{
    document.getElementById("div1").style.display = "";
    document.getElementById("div2").style.display = "none";
    E9.User.logout();
}

  function getState()
{
  	onGetState();
}



  function call() 
{
	 	h=0;
	  m=0;
	  s=0;
	  var seat="";
	  var outphonenumber="";
    var callphonenumber = document.getElementById("200").value;
    var partten = /^1[3,5,8,7]\d{9}$/;
    var parttengh = /^(0\d{2,3}|\d{3,12})$/;
    if(!partten.test(callphonenumber)){
    	  if(!parttengh.test(callphonenumber)){
    	  	 alert("你输入非法号码");
    	  	 return false;
    	  	}
    	}
    if(navigator.appName.indexOf("Explorer")>-1){
    	 seat = document.getElementById("jtdiv").innerText;
    	 outphonenumber=document.getElementById("202").innerText;
    	}else{
    	seat = document.getElementById("jtdiv").textContent;	
      outphonenumber=document.getElementById("202").textContent;
    	}
   
    var seatFormatPhone=NumberConversion(seat);
    var formatPhone = NumberConversion(callphonenumber);
    var formatoutphone=NumberConversion(outphonenumber);
    E9.Session.makeCall(seatFormatPhone[1], formatPhone[1], formatoutphone[1], "");
    document.getElementById("hujiaojnum1").innerHTML=seat;
    document.getElementById("hujiaophone").innerHTML=callphonenumber;
    document.getElementById("hujiaojnum2").innerHTML=seat;
    document.getElementById("hujiaophone2").innerHTML=callphonenumber;
    //弹出拨打中div
    openDiv("div3");   
}
  
 function popupDiv(div_id)
{
  var div_obj = $("#" + div_id);
  var windowWidth = document.documentElement.clientWidth;
  var windowHeight = document.documentElement.clientHeight;
  var popupHeight = div_obj.height();
  var popupWidth = div_obj.width();
  div_obj.css({ "position": "absolute" }).animate({ left: windowWidth / 2 - popupWidth / 2, top: windowHeight / 2 - popupHeight / 2, opacity: "show" }, "show");
} 

  function hookUser()
{
  	E9.Session.endCall(session_id);
  	session_id = -1;
  	close("div3");
  	close("div4");
  	openDiv("div2");
}

  function addSeat()
{
		var seatphonenumber = document.getElementById("seatphonenumber").value;
		var formatPhone = NumberConversion(seatphonenumber);
		onAddSeat(formatPhone[1]);
}

  function delSeat()
{
	var seatphonelist =  document.getElementsByName("setcurseat");
	for(var i=0;i<seatphonelist.length;i++)
   {
  if(seatphonelist[i].checked==true)
   {
		var callphonenumber = seatphonelist[i].value;
		onDelSeat(callphonenumber);
		return;
   }
   }
}

  function switchSeat()
{
		var seatphonelist = document.getElementsByName("setcurseat");
		for(var i=0;i<seatphonelist.length;i++)
		{
		if(seatphonelist[i].checked==true)
		{
			var callphonenumber = seatphonelist[i].value;
			onSwitchSeat(callphonenumber);
			return;
		}
		}
}

  function switchOut()
{
		var dispphonelist = document.getElementsByName("setcurdisp");
		for(var i=0;i<dispphonelist.length;i++)
		{
		if(dispphonelist[i].checked==true)
		{
			var callphonenumber = dispphonelist[i].value;
			onSwitchOut(callphonenumber);
			return;                           
		}
		}
}

  function getOrgInfo()
{
  	onGetOrgInfo();
}

  function switchOrgInfo()
{
  	var orglist = document.getElementsByName("setcurorginfo");
		for(var i=0;i<orglist.length;i++)
		{
		if(orglist[i].checked==true)
		{
			var orgid = parseInt(orglist[i].value);
			onSwitchOrgInfo(orgid);
			return;
		}
		}
}

  function callTrans()
{
		if(callCurTrans == 2)
		{
			var transTypeList = document.getElementsByName("callTransName");
			var transType = 1;
			for(var i=0; i<transTypeList.length; i++)
			{
				if(transTypeList[i].checked == true)
				{
					transType = parseInt(transTypeList[i].value);
					break;
				}
			}
			onCallTrans(document.getElementById("203").value, transType);
			if(transType == 1)
				callCurTrans = 3;
			else
				callCurTrans = 0;
			document.getElementById("transDecidebtn").style.display = "";
			document.getElementById("callConfirmID").disabled = "disabled";
		}
}

  function callConfirm()
{
  	onDecideTrans(0);
  	document.getElementById("transDecidebtn").style.display = "none";
}

  function callCancel()
{
  	onDecideTrans(1);
  	document.getElementById("transDecidebtn").style.display = "none";
    callCurTrans = 2;
}
  
  function getCallLineState()
{
  	onGetCallLineState();
}

  function addTrace(trace)
{
				log.innerHTML += trace;	
				log.innerHTML += "<br />"
}