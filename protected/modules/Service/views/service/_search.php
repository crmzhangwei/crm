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
		<?php echo $form->label($model,'cust_no'); ?>
		<?php echo $form->textField($model,'cust_no',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cust_name'); ?>
		<?php echo $form->textField($model,'cust_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shop_name'); ?>
		<?php echo $form->textField($model,'shop_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'corp_name'); ?>
		<?php echo $form->textField($model,'corp_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shop_url'); ?>
		<?php echo $form->textField($model,'shop_url',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shop_addr'); ?>
		<?php echo $form->textField($model,'shop_addr',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'qq'); ?>
		<?php echo $form->textField($model,'qq',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mail'); ?>
		<?php echo $form->textField($model,'mail',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datafrom'); ?>
		<?php echo $form->textField($model,'datafrom',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category'); ?>
		<?php echo $form->textField($model,'category'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cust_type'); ?>
		<?php echo $form->textField($model,'cust_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'eno'); ?>
		<?php echo $form->textField($model,'eno',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iskey'); ?>
		<?php echo $form->textField($model,'iskey'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'assign_eno'); ?>
		<?php echo $form->textField($model,'assign_eno',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'assign_time'); ?>
		<?php echo $form->textField($model,'assign_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'next_time'); ?>
		<?php echo $form->textField($model,'next_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'memo'); ?>
		<?php echo $form->textField($model,'memo',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'creator'); ?>
		<?php echo $form->textField($model,'creator'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->