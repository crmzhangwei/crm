<?php
/* @var $this CusttypeController */
/* @var $model CustType */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cust-type-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><span class="required">*</span>为必填项.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'lib_type'); ?>
		<?php echo $form->textField($model,'lib_type'); ?>
		<?php echo $form->error($model,'lib_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type_no'); ?>
		<?php echo $form->textField($model,'type_no',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'type_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type_name'); ?>
		<?php echo $form->textField($model,'type_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'type_name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->