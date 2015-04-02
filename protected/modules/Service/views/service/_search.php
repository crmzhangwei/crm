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
		<?php echo $form->dropDownList($model,'dept',$this->getDeptArr()); ?>
	</div>
        <div class="row">
		<?php echo $form->label($model,'group'); ?>
		<?php echo $form->textField($model,'group',array('size'=>10,'maxlength'=>20)); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'cust_name'); ?>
		<?php echo $form->textField($model,'cust_name',array('size'=>10,'maxlength'=>20)); ?>
	</div>

        <div class="row">
		<?php echo $form->label($model,'cust_type'); ?>
		<?php echo $form->dropDownList($model,'cust_type',$this->getCustTypeArr()); ?>
	</div>
  

	<div class="row">
		<?php echo $form->label($model,'qq'); ?>
		<?php echo $form->textField($model,'qq',array('size'=>10,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'webchat'); ?>
		<?php echo $form->textField($model,'webchat',array('size'=>10,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ww'); ?>
		<?php echo $form->textField($model,'ww',array('size'=>10,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category'); ?>
		<?php echo $form->dropDownList($model,'category',$this->getCategoryArr()); ?>
	</div> 
	 

	<div class="row buttons">
		<?php echo CHtml::submitButton('搜索'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->