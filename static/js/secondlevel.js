
function listgroup(obj){
    var deptid = $(obj).val();
    var groupStr = '<option value ="0">--请选择组--</option>';
    if (deptid == 0) {
        $('#groupinfo').html(groupStr);
        $('#userinfo').html('<option value ="0">--请选择人员--</option>');
        $('#userid').val('');
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
