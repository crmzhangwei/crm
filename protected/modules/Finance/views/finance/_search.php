<?php
/* @var $this FinanceController */
/* @var $model Finance */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<!--
	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>
-->
	<div class="row">
		<?php echo $form->label($model,'cust_id'); ?>
		<?php echo $form->textField($model,'cust_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sale_user'); ?>
		<?php echo $form->textField($model,'sale_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trans_user'); ?>
		<?php echo $form->textField($model,'trans_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'acct_number'); ?>
		<?php echo $form->textField($model,'acct_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'acct_amount'); ?>
		<?php echo $form->textField($model,'acct_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'acct_time'); ?>
		<?php echo $form->textField($model,'acct_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'creator'); ?>
		<?php echo $form->textField($model,'creator'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('搜索'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->