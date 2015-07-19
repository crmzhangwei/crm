
function listgroup(obj){
    var deptid = $(obj).val();
    var groupStr = '';
    if (deptid == 0) {
        $('#groupinfo').html(groupStr);
        $('#userinfo').html('<option value ="0">--请选择人员--</option>');
        $('#userid').val('');
        $('#usereno').val('');
    }
    else{
        $('#userinfo').html('<option value ="0">--请选择人员--</option>');
        $('#userid').val('');
    }
    $.post("./index.php?r=Customer/customerinfo/getGroup",{'deptid':deptid},function(data)
        {
            for(i in data)
            {
                groupStr += '<option value ='+i+'>'+data[i]+'</option>';
            }
            $('#groupinfo').html(groupStr);
        },'json')
}

    function listuser(obj)
    {
      	var gid = $(obj).val();
        var deptid = $('#search_dept').val();
    	var optStr = '';
    	if (gid == 0) {
            $('#userinfo').html(optStr);
            $('#userid').val('');
            $('#usereno').val('');
      	}
        else{
            $('#userid').val('');
        }
      	$.post("./index.php?r=Customer/customerinfo/getUsers",{'gid':gid,'deptid':deptid},function(data)
	    {
	    	
	    	for(i in data)
	        {
	         	optStr += '<option value ='+i+'>'+data[i]+'</option>';
	        }
	        $('#userinfo').html(optStr);
	    },'json')
	    
    }

    function enoval(obj){
    	var eno = $(obj).val();
    	if (eno == 0) {
    		$('#userid').val('');
    	}
    	else{
    		$('#userid').val(eno);
                $('#usereno').val(eno);
    	}
    }
    
    
     function exportToExcel(){
         $("#isexcel").val(1);
         $("#user-form").submit();
     }
     function sub(){
         $("#isexcel").val(0);
         $("#user-form").submit();
     }
    