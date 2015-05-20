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
 
	<div class="row">
		<?php echo $form->dropDownList($model, "searchtype", array('1'=>'客户名称','2'=>'QQ','3'=>'电话')) ?>
		<?php echo $form->textField($model,'keyword',array('size'=>30,'maxlength'=>20)); ?>
                <?php echo CHtml::submitButton('搜索',array('class' => 'btn btn-sm btn-primary')); ?>
	</div> 
 

<?php $this->endWidget(); ?>

</div><!-- search-form -->