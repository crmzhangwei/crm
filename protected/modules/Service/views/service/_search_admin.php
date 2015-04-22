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
       <table class="table table-bordered" style="width:50%;">
            <tr>
                <td width="5%" nowrap="nowrap"><?php echo $form->labelEx($model,'cust_name'); ?></td>
                <td width="5%" nowrap="nowrap">
                   <?php echo $form->textField($model,'cust_name',array('size'=>10,'maxlength'=>20)); ?>
                </td> 
                <td width="5%" nowrap="nowrap"><?php echo $form->labelEx($model,'begin_end_time'); ?></td>
                <td width="5%" nowrap="nowrap">
                     <?php echo $form->textField($model,'createtime_start',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;',)); ?>
                     to 
                     <?php echo $form->textField($model,'createtime_end',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;')); ?>
                </td>
                <td width="5%" nowrap="nowrap"><?php echo $form->labelEx($model,'total_money'); ?></td>
                <td width="5%" nowrap="nowrap">
                    <?php echo $form->textField($model,'total_money',array('size'=>10,'maxlength'=>20)); ?>
                </td>
                <td width="5%" nowrap="nowrap"><?php echo $form->labelEx($model,'ww'); ?></td>
                <td width="5%" nowrap="nowrap">
                   <?php echo $form->textField($model,'ww',array('size'=>10,'maxlength'=>20)); ?>
                </td> 
                <td width="10%" nowrap="nowrap" colspan="2" align="center"> 
                   <?php echo CHtml::submitButton('搜索'); ?>
                </td> 
            </tr>  
    </table>    
	 

<?php $this->endWidget(); ?>

</div><!-- search-form -->