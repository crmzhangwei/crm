<?php
/* @var $this CustomerinfoController */
/* @var $model CustomerInfo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-info-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cust_name'); ?>
		<?php echo $form->textField($model,'cust_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cust_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shop_name'); ?>
		<?php echo $form->textField($model,'shop_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'shop_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'corp_name'); ?>
		<?php echo $form->textField($model,'corp_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'corp_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shop_url'); ?>
		<?php echo $form->textField($model,'shop_url',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'shop_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shop_addr'); ?>
		<?php echo $form->textField($model,'shop_addr',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'shop_addr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qq'); ?>
		<?php echo $form->textField($model,'qq',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mail'); ?>
		<?php echo $form->textField($model,'mail',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'mail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datafrom'); ?>
		<?php echo $form->textField($model,'datafrom',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'datafrom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php echo $form->textField($model,'category'); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>

	<!-- <div class="row">
		<?php echo $form->labelEx($model,'cust_type'); ?>
		<?php echo $form->textField($model,'cust_type'); ?>
		<?php echo $form->error($model,'cust_type'); ?>
	</div> -->

	<!-- <div class="row">
		<?php echo $form->labelEx($model,'eno'); ?>
		<?php echo $form->textField($model,'eno',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'eno'); ?>
	</div> -->

	<!-- <div class="row">
		<?php echo $form->labelEx($model,'assign_eno'); ?>
		<?php echo $form->textField($model,'assign_eno',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'assign_eno'); ?>
	</div> -->

	<!-- <div class="row">
		<?php echo $form->labelEx($model,'assign_time'); ?>
		<?php echo $form->textField($model,'assign_time'); ?>
		<?php echo $form->error($model,'assign_time'); ?>
	</div> -->

	<!-- <div class="row">
		<?php echo $form->labelEx($model,'next_time'); ?>
		<?php echo $form->textField($model,'next_time'); ?>
		<?php echo $form->error($model,'next_time'); ?>
	</div> -->

	<div class="row">
		<?php echo $form->labelEx($model,'memo'); ?>
		<?php echo $form->textField($model,'memo',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'memo'); ?>
	</div>

	<!-- <div class="row">
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;')); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div> -->

	<!-- <div class="row">
		<?php echo $form->labelEx($model,'creator'); ?>
		<?php echo $form->textField($model,'creator',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'creator'); ?>
	</div> -->

	<div class="row">
		<?php echo $form->labelEx($model,'eno'); ?>
		<?php echo CHtml::dropDownList('dept','',$deptArr,array('onchange'=>'listgroup(this)'));?>
		<select id="groupinfo" name="group" onchange="listuser(this)">
			<option value ="0">--请选择组--</option>
		</select>

		<select id='userinfo' name="users" onchange="enoval(this)">	
			<option value ="0">---请选择人员---</option>
		</select>
		<?php echo $form->textField($model,'eno',array('id'=>'userid','size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'eno'); ?>
	</div> 

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
	function listgroup(obj)
    {
      	var deptid = $(obj).val();
      	var groupStr = '<option value ="0">--请选择组--</option>';
      	if (deptid == 0) {
      		$('#groupinfo').html(groupStr);
      		$('#userinfo').html('<option value ="0">--请选择人员--</option>');
      		$('#userid').val('');
      	};
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
    	var optStr = '<option value ="0">---请选择人员---</option>';
    	if (gid == 0) {
      		$('#userinfo').html(optStr);
      		$('#userid').val('');
      	};
      	$.post("./index.php?r=Customer/customerinfo/getUsers",{'gid':gid},function(data)
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
    	}
    }
    
</script> 