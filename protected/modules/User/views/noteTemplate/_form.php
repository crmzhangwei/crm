<?php
/* @var $this NoteTemplateController */
/* @var $model NoteTemplate */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'note-template-form',
	'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
    'enableClientValidation' => true,
    'action' => false,
	'enableAjaxValidation' => false,
)); ?>


	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model, 'id') ?>
	<table>
		<tr>
			<td><?php echo $form->labelEx($model,'tname'); ?></td>
			<td><?php echo $form->textField($model,'tname',array('size'=>25,'maxlength'=>25)); ?></td>
			<td><?php echo $form->error($model,'tname'); ?></td>
		</tr>
		
		<tr>
			<td><?php echo $form->labelEx($model,'content'); ?></td>
			<td><?php echo $form->textarea($model,'content',array('rows'=>3,'cols'=>35,'size'=>60,'maxlength'=>200)); ?></td>
			<td><?php echo $form->error($model,'content'); ?></td>
		</tr>
	</table>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '保存', array('class' => 'btn btn-sm btn-primary', 'id' => 'createUserBtn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	$('#createUserBtn').on('click',function(){
		public.AjaxSaveForm({
		obj: $("#createUserBtn"),
		url: '<?php echo $model->isNewRecord ?$this->createUrl("/User/noteTemplate/create") :$this->createUrl("/User/noteTemplate/update"); ?>',
		data: $("#note-template-form").serialize(),
		callback: function (result) {
			bootbox.alert(result.msg, function () {
				if (result.code == 1)
					window.location.reload();
			});
		}
		});
		
	})
</script>