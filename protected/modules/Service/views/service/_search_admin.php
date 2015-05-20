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
       <table class="table table-striped table-bordered table-hover table-projects" style="width:50%;">
            <tr>
                <td width="5%" nowrap="nowrap"><?php echo $form->dropDownList($model,'searchtype',array('1'=>'客户名称','2'=>'金额','3'=>'旺旺','4'=>'微信')); ?></td>
                <td width="5%" nowrap="nowrap">
                   <?php echo $form->textField($model,'keyword',array('size'=>10,'maxlength'=>20)); ?>
                </td> 
                <td width="5%" nowrap="nowrap"><?php echo $form->labelEx($model,'begin_end_time'); ?></td>
                <td width="5%" nowrap="nowrap">
                     <?php echo $form->textField($model,'createtime_start',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;',)); ?>
                     to 
                     <?php echo $form->textField($model,'createtime_end',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;')); ?>
                </td> 
                <td width="10%" nowrap="nowrap" colspan="2" align="center"> 
                   <?php echo CHtml::submitButton('搜索',array('class' => 'btn btn-sm btn-primary')); ?>
                </td> 
            </tr>  
    </table>    
	 

<?php $this->endWidget(); ?>

</div><!-- search-form -->