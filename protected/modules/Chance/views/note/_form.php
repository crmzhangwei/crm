<?php
/* @var $this NoteController */
/* @var $model NoteInfo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'note-info-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cust_id'); ?>
		<?php echo $form->textField($model,'cust_id'); ?>
		<?php echo $form->error($model,'cust_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cust_info'); ?>
		<?php echo $form->textField($model,'cust_info',array('maxlength'=>200)); ?>
		<?php echo $form->error($model,'cust_info'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'requirement'); ?>
		<?php echo $form->textField($model,'requirement',array('maxlength'=>200)); ?>
		<?php echo $form->error($model,'requirement'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'service'); ?>
		<?php echo $form->textField($model,'service',array('maxlength'=>200)); ?>
		<?php echo $form->error($model,'service'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dissent'); ?>
		<?php echo $form->textField($model,'dissent',array('maxlength'=>200)); ?>
		<?php echo $form->error($model,'dissent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'next_followup'); ?>
		<?php echo $form->textField($model,'next_followup',array('maxlength'=>200)); ?>
		<?php echo $form->error($model,'next_followup'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'memo'); ?>
		<?php echo $form->textField($model,'memo',array('maxlength'=>200)); ?>
		<?php echo $form->error($model,'memo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isvalid'); ?>
		<?php echo $form->textField($model,'isvalid'); ?>
		<?php echo $form->error($model,'isvalid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iskey'); ?>
		<?php echo $form->textField($model,'iskey'); ?>
		<?php echo $form->error($model,'iskey'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'next_contact'); ?>
		<?php echo $form->textField($model,'next_contact'); ?>
		<?php echo $form->error($model,'next_contact'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dial_id'); ?>
		<?php echo $form->textField($model,'dial_id'); ?>
		<?php echo $form->error($model,'dial_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'eno'); ?>
		<?php echo $form->textField($model,'eno'); ?>
		<?php echo $form->error($model,'eno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('提 交',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->