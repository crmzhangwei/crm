/**
 * DIV遮盖层JS代码
 */

// 判断浏览器是否为IE
function isIE() {
	return (document.all && window.ActiveXObject && !window.opera) ? true
			: false;
}

// 取得页面的高宽
function getBodySize() {
	var bodySize = [];
	with (document.body) {
		// 如果滚动条的宽度大于页面的宽度，取得滚动条的宽度，否则取页面宽度
		bodySize[0] = (scrollWidth > clientWidth) ? scrollWidth : clientWidth;
		// 如果滚动条的高度大于页面的高度，取得滚动条的高度，否则取高度
		bodySize[1] = (scrollHeight > clientHeight) ? scrollHeight
				: clientHeight;
	}
	return bodySize;
}
// 创建遮盖层
function popCoverDiv() {
	if (document.getElementById("cover_div")) {
		// 如果存在遮盖层，则让其显示
		document.getElementById("cover_div").style.display = 'block';
	} else {
		// 否则创建遮盖层
		var coverDiv = document.createElement('div');
		document.body.appendChild(coverDiv);
		coverDiv.id = 'cover_div';
		// 设置遮盖层的CSS属性
		with (coverDiv.style) {
			position = 'absolute';
			background = '#7EADDC';
			left = '0px';
			top = '0px';
			var bodySize = getBodySize();
			width = bodySize[0] + 'px'
			height = bodySize[1] + 'px';
			zIndex = 0;
			if (isIE()) {
				filter = "Alpha(Opacity=60)";// IE逆境
			} else {
				opacity = 0.6;
			}
		}
	}
}

// 显示设置电话号码类型表单
function showFormDiv(divName) {
	var divObj = document.getElementById(divName);
	divObj.style.border = "1px solid #7EADDC";
	divObj.style.display = "block";
}

// 设置setPhoneNoTypeForm DIV层的样式
function change(divName) {
	var divObj = document.getElementById(divName);
	divObj.style.position = "absolute";
	//divObj.style.border = "1px solid #7EADDC";
	divObj.style.backgroundImage = "url(images/bg.gif)";
	var bodySize = getBodySize();
	divObj.style.left = "35%";//bodySize[0] / 4 + "px";
	divObj.style.top = "30%";
	divObj.style.width = "400px";
	//divObj.style.height = 200 + "px";

}
/*
 * 打开DIV层
 */
function openDiv(divName) {
	change(divName);

	showFormDiv(divName);


	popCoverDiv();

	// jquery遮罩插件，屏蔽 select 这类不能被遮盖的 HTML 特殊控件
	try{	
	jQuery('#'+divName).bgiframe();

	}catch(e){}
	
	void (0);// 不进行任何操作
}
/*
 * 关闭DIV层
 */
function close(divName) {
	document.getElementById(divName).style.display = 'none';
	//if(document.getElementById("cover_div")){
	//  document.getElementById("cover_div").style.display = 'none';
	//}
	void (0);// 不进行任何操作
}
