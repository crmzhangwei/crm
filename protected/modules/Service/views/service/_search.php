<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
        <div class="row">
		<?php echo $form->label($model,'dept'); ?>
		<?php echo $form->textField($model,'dept',array('size'=>60,'maxlength'=>100)); ?>
	</div>
        <div class="row">
		<?php echo $form->label($model,'group'); ?>
		<?php echo $form->textField($model,'group',array('size'=>60,'maxlength'=>100)); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'cust_name'); ?>
		<?php echo $form->textField($model,'cust_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

        <div class="row">
		<?php echo $form->label($model,'cust_type'); ?>
		<?php echo $form->textField($model,'cust_type'); ?>
	</div>
  

	<div class="row">
		<?php echo $form->label($model,'qq'); ?>
		<?php echo $form->textField($model,'qq',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'webchat'); ?>
		<?php echo $form->textField($model,'mail',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ww'); ?>
		<?php echo $form->textField($model,'datafrom',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category'); ?>
		<?php echo $form->textField($model,'category'); ?>
	</div> 
	 

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->