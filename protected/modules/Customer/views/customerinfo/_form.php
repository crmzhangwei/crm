<?php
/* @var $this CustomerinfoController */
/* @var $model CustomerInfo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-info-form',
	'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
    'enableClientValidation' => true,
    'action' => false,
	'enableAjaxValidation' => false,
)); ?>

	<!-- <p class="note">包含 <span class="required">*</span> 为必填项.</p> -->

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model, 'id') ?>
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
		<td><?php echo $form->labelEx($model,'phone2'); ?></td>
		<td><?php echo $form->textField($model,'phone2',array('size'=>30,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone2'); ?></td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'phone3'); ?></td>
		<td><?php echo $form->textField($model,'phone3',array('size'=>30,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone3'); ?></td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'phone4'); ?></td>
		<td><?php echo $form->textField($model,'phone4',array('size'=>30,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone4'); ?></td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'phone5'); ?></td>
		<td><?php echo $form->textField($model,'phone5',array('size'=>30,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone5'); ?></td>
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
		<td><?php echo $form->labelEx($model,'iskey'); ?></td>
		<td><?php echo $form->textField($model,'iskey',array('size'=>15,'maxlength'=>30)); echo '<span class="red"> 填: 1重点 0非重点<span>';?>
		<?php echo $form->error($model,'iskey'); ?></td>
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
		<select id="groupinfo3" name="group" onchange="listuser(this)">
			<option value ="0">--请选择组--</option>
		</select>
		<?php else: 
		    echo   CHtml::dropDownList('group', intval($user_info['group_id']), $user_info['group_arr'], array('id'=>"groupinfo3",'onchange'=>"listuser(this)"));
		     endif;?>

		<?php if($model->isNewRecord):?>
		<select id='userinfo3' name="users" onchange="enoval(this)">	
			<option value ="0">---请选择人员---</option>
		</select>
		<?php else: 
		    echo   CHtml::dropDownList('users', $user_info['eno'], $user_info['user_arr'], array('id'=>"userinfo3",'onchange'=>"enoval(this)"));
		endif;?>
		</td>
	</tr> 
	<tr style="display:none">
		<td><?php echo $form->textField($model,'eno',array('id'=>'userid','size'=>10,'maxlength'=>10)); ?></td>
		<td><?php echo $form->error($model,'eno'); ?>
		<?php echo $form->textField($model,'oldEno',array('id'=>'oldEno','size'=>10,'maxlength'=>10)); ?></td>
	</tr>
	<tr>
		<td>
		<?php echo CHtml::Button($model->isNewRecord ? '创建' : '更新', array('class' => 'btn btn-sm btn-primary', 'id' => 'createUserBtn')); ?>
		</td>	
	</tr>
	</table>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    function listgroup(obj)
    {
      	var deptid = $(obj).val();
      	var groupStr = '';
      	if (deptid == 0) {
            $('#groupinfo3').html(groupStr);
            $('#userinfo3').html('<option value ="0">--请选择人员--</option>');
            $('#userid').val('');
      	}
        else{
            $('#userinfo3').html('<option value ="0">--请选择人员--</option>');
            $('#userid').val('');
        }
      	$.post("./index.php?r=Customer/customerinfo/getGroup",{'deptid':deptid},function(data)
	    {
	    	
	    	for(i in data)
	        {
	         	groupStr += '<option value ='+i+'>'+data[i]+'</option>';
	        }
	        $('#groupinfo3').html(groupStr);
	    },'json')
    }

    function listuser(obj)
    {
      	var gid = $(obj).val();
        var deptid = $('#dept').val();
    	var optStr = '';
    	if (gid == 0) {
            $('#userinfo3').html(optStr);
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
	        $('#userinfo3').html(optStr);
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