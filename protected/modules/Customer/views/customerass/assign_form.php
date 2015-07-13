<?php
/* @var $this CustomerinfoController */
/* @var $model CustomerInfo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-ass-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'eno'); ?>
		<?php echo CHtml::dropDownList('dept','',$deptArr,array('onchange'=>'listgroup(this)'));?>
		<select id="groupinfo2" name="group" onchange="listuser(this)">
			<option value ="0">--请选择组--</option>
		</select>

		<select id='userinfo2' name="users" onchange="enoval(this)">	
			<option value ="0">---请选择人员---</option>
		</select>
		
	</div> 
	<div class="row" style="display:none;">
		<?php echo $form->textField($model,'eno',array('id'=>'userid','size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'eno'); ?>
		<?php echo $form->labelEx($model,'ids'); ?>
		<?php echo $form->textField($model,'ids',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row buttons" style="margin-top:40px">
		<?php echo CHtml::submitButton($model->isNewRecord ? '分配' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
	function listgroup(obj)
    {
      	var deptid = $(obj).val();
      	var groupStr = '';
      	if (deptid == 0) {
            $('#groupinfo2').html(groupStr);
            $('#userinfo2').html('<option value ="0">--请选择人员--</option>');
            $('#userid').val('');
      	}
        else{
            $('#userinfo2').html('<option value ="0">--请选择人员--</option>');
            $('#userid').val('');
        }
      	$.post("./index.php?r=Customer/customerinfo/getGroup",{'deptid':deptid},function(data)
	    {
	    	
	    	for(i in data)
	        {
	         	groupStr += '<option value ='+i+'>'+data[i]+'</option>';
	        }
	        $('#groupinfo2').html(groupStr);
	    },'json')
    }

    function listuser(obj)
    {
      	var gid = $(obj).val();
        var deptid = $('#dept').val();
    	var optStr = '';
    	if (gid == 0) {
            $('#userinfo2').html(optStr);
            $('#userid').val('');
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
	        $('#userinfo2').html(optStr);
	    },'json')
	    
    }

    function enoval(obj){
    	var eno = $(obj).val();
    	if (eno == 0) {
    		$('#userid').val('');
    	}
    	else{
    		$('#userid').val(eno);
    	}
    }
    
</script> 