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

	<p class="note"><span class="required">*</span>字段为必填项.</p>

	<?php echo $form->errorSummary($model); ?>

	 
     
        <div class="row" >
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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->