function NumberConversion(telephoneNumber) {
	var numberstr = telephoneNumber;
	var returnVal = 0;
	var numberlen = telephoneNumber.length;
	
	if (telephoneNumber.substring(0,2)=="00"){
		numberstr = telephoneNumber.substring(2,numberlen);
	}
	else if(telephoneNumber.substring(0,1)=="0"){
		numberstr = "86" + telephoneNumber.substring(1,numberlen);
	}
	else if(telephoneNumber.substring(0,1)=="1" && telephoneNumber.length == 11){
		numberstr = "86" + telephoneNumber;
	}
	else if(telephoneNumber.substring(0,5)=="95040"){
		numberstr = "86" + telephoneNumber;
	}
	else if(telephoneNumber.substring(0,5)=="95013"){
		numberstr = "86" + telephoneNumber;
	}
	else if(telephoneNumber.substring(0,3)=="400"){
		numberstr = "86" + telephoneNumber;
	}
	else if(telephoneNumber.substring(0,3)=="800"){
		numberstr = "86" + telephoneNumber;
	}
	else{
	    returnVal = 1;
	}
	return [returnVal,numberstr];
};