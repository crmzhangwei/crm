<?php
/* @var $this NoteController */
/* @var $model NoteInfo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cust_id'); ?>
		<?php echo $form->textField($model,'cust_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cust_info'); ?>
		<?php echo $form->textField($model,'cust_info',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'requirement'); ?>
		<?php echo $form->textField($model,'requirement',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'service'); ?>
		<?php echo $form->textField($model,'service',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dissent'); ?>
		<?php echo $form->textField($model,'dissent',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'next_followup'); ?>
		<?php echo $form->textField($model,'next_followup',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'memo'); ?>
		<?php echo $form->textField($model,'memo',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isvalid'); ?>
		<?php echo $form->textField($model,'isvalid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iskey'); ?>
		<?php echo $form->textField($model,'iskey'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'next_contact'); ?>
		<?php echo $form->textField($model,'next_contact'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dial_id'); ?>
		<?php echo $form->textField($model,'dial_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'eno'); ?>
		<?php echo $form->textField($model,'eno'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->