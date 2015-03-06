<?php
/* @var $this FinanceController */
/* @var $model Finance */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'finance-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cust_id'); ?>
		<?php echo $form->textField($model,'cust_id'); ?>
		<?php echo $form->error($model,'cust_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sale_user'); ?>
		<?php echo $form->textField($model,'sale_user'); ?>
		<?php echo $form->error($model,'sale_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trans_user'); ?>
		<?php echo $form->textField($model,'trans_user'); ?>
		<?php echo $form->error($model,'trans_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'acct_number'); ?>
		<?php echo $form->textField($model,'acct_number'); ?>
		<?php echo $form->error($model,'acct_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'acct_amount'); ?>
		<?php echo $form->textField($model,'acct_amount'); ?>
		<?php echo $form->error($model,'acct_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'acct_time'); ?>
		<?php echo $form->textField($model,'acct_time'); ?>
		<?php echo $form->error($model,'acct_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'creator'); ?>
		<?php echo $form->textField($model,'creator'); ?>
		<?php echo $form->error($model,'creator'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->