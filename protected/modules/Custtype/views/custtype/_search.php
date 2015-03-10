<?php
/* @var $this CusttypeController */
/* @var $model CustType */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

 

	<div class="row">
		<?php echo $form->label($model,'lib_type'); ?>
		<?php echo $form->textField($model,'lib_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type_no'); ?>
		<?php echo $form->textField($model,'type_no',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type_name'); ?>
		<?php echo $form->textField($model,'type_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('搜索'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->