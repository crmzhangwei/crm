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
     'action' => false,
	'enableAjaxValidation'=>false,
)); ?>

	<!-- <p class="note">包含 <span class="required">*</span> 为必填项.</p> -->

	<?php echo $form->errorSummary($model); ?>
	<table>
	<tr>
		<td width="95"><?php echo $form->labelEx($model,'cust_name'); ?></td>
		<td><?php echo $form->textField($model,'cust_name',array('size'=>55,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cust_name'); ?></td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'shop_name'); ?></td>
		<td><?php echo $form->textField($model,'shop_name',array('size'=>55,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'shop_name'); ?></td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'corp_name'); ?></td>
		<td><?php echo $form->textField($model,'corp_name',array('size'=>55,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'corp_name'); ?></td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'shop_url'); ?></td>
		<td><?php echo $form->textField($model,'shop_url',array('size'=>55,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'shop_url'); ?></td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'shop_addr'); ?></td>
		<td><?php echo $form->textField($model,'shop_addr',array('size'=>55,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'shop_addr'); ?></td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'phone'); ?></td>
		<td><?php echo $form->textField($model,'phone',array('size'=>30,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone'); ?></td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'qq'); ?></td>
		<td><?php echo $form->textField($model,'qq',array('size'=>30,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'qq'); ?></td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'mail'); ?></td>
		<td><?php echo $form->textField($model,'mail',array('size'=>55,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'mail'); ?></td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'datafrom'); ?></td>
		<td><?php echo $form->textField($model,'datafrom',array('size'=>55,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'datafrom'); ?></td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'category'); ?></td>
		<td><?php echo $form->dropDownList($model, 'category' ,$category);?>
		<?php echo $form->error($model,'category'); ?></td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'memo'); ?></td>
		<td><?php echo $form->textField($model,'memo',array('size'=>55,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'memo'); ?></td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'eno'); ?></td>
		<td>
		<?php if($model->isNewRecord):
			echo CHtml::dropDownList('dept','',$deptArr,array('onchange'=>'listgroup(this)'));
		?>
		<?php else:
			echo CHtml::dropDownList('dept',$user_info['dept_id'],$deptArr,array('onchange'=>'listgroup(this)'));
		endif;?>
		
		<?php if($model->isNewRecord):?>
		<select id="groupinfo" name="group" onchange="listuser(this)">
			<option value ="0">--请选择组--</option>
		</select>
		<?php else: 
		    echo   CHtml::dropDownList('group', intval($user_info['group_id']), $user_info['group_arr'], array('id'=>"groupinfo",'onchange'=>"listuser(this)"));
		     endif;?>

		<?php if($model->isNewRecord):?>
		<select id='userinfo' name="users" onchange="enoval(this)">	
			<option value ="0">---请选择人员---</option>
		</select>
		<?php else: 
		    echo   CHtml::dropDownList('users', $user_info['eno'], $user_info['user_arr'], array('id'=>"userinfo",'onchange'=>"enoval(this)"));
		endif;?>
		</td>
	</tr> 
	<tr style="display: none">
		<td><?php echo $form->textField($model,'eno',array('id'=>'userid','size'=>10,'maxlength'=>10)); ?></td>
		<td><?php echo $form->error($model,'eno'); ?>
		<?php echo $form->textField($model,'oldEno',array('id'=>'oldEno','size'=>10,'maxlength'=>10)); ?></td>
	</tr>
	<tr>
		<td>
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '更新', array('class' => 'btn btn-sm btn-primary', 'id' => 'createUserBtn')); ?>
		</td>	
	</tr>
	</table>

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
        var deptid = $('#dept').val();
    	var optStr = '<option value ="0">---请选择人员---</option>';
    	if (gid == 0) {
            $('#userinfo').html(optStr);
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
    $(function(){
		var gonghao = $("#userid").val();
		$("#oldEno").val(gonghao);
	});
	$('#createUserBtn').on('click',function(){
		public.AjaxSaveForm({
		obj: $("#createUserBtn"),
		url: '<?php echo $model->isNewRecord ?$this->createUrl("/Customer/customerinfo/create") :$this->createUrl("/Customer/customerinfo/update"); ?>',
		data: $("#customer-info-form").serialize(),
		callback: function (result) {
			bootbox.alert(result.msg, function () {
				if (result.code == 1)
					window.location.reload();
			});
		}
		});
		
	})
	
</script> 