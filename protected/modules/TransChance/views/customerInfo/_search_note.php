<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl('/Service/new/historyNoteList'),
	'method'=>'get',
)); ?>
        
        <table class="table table-bordered" style="width:50%;">
            <tr>
                <td width="5%" nowrap="nowrap"><?php echo $form->labelEx($model,'cust_info'); ?></td>
                <td width="5%" nowrap="nowrap">
                     <?php echo $form->textField($model,'cust_info'); 
                        echo Chtml::hiddenField("NoteInfo[cust_id]", $custmodel->id);
                     ?>
                </td> 
                <td width="5%" nowrap="nowrap"><?php echo $form->labelEx($model,'requirement'); ?></td>
                <td width="5%" nowrap="nowrap">
                     <?php echo $form->textField($model,'requirement'); ?>
                </td>
                <td width="5%" nowrap="nowrap"><?php echo $form->labelEx($model,'service'); ?></td>
                <td width="5%" nowrap="nowrap">
                     <?php echo $form->textField($model,'service'); ?>
                </td> 
                <td><?php echo CHtml::submitButton('搜索',array('class' => 'btn btn-sm btn-primary')); ?></td>
            </tr> 
             
        </table>  
	 

<?php $this->endWidget(); ?>

</div><!-- search-form -->