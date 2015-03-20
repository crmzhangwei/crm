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
		<?php echo $form->label($model,'cust_name'); ?>
		<?php echo $form->textField($model,'cust_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>
        
        <div class="row">
		<?php echo $form->label($model,'create_time'); ?>
		<?php echo $form->textField($model,'createtime_start',array('size'=>20,'maxlength'=>20)); ?>
                to 
                <?php echo $form->textField($model,'createtime_end',array('size'=>20,'maxlength'=>20)); ?>
	</div>
    
        <div class="row">
		<?php echo $form->label($model,'total_money'); ?>
		<?php echo $form->textField($model,'total_money'); ?>
	</div> 

	<div class="row">
		<?php echo $form->label($model,'ww'); ?>
		<?php echo $form->textField($model,'datafrom',array('size'=>20,'maxlength'=>20)); ?>
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