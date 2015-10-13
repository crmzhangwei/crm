<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl('/Chance/customerInfo/historyNoteList'),
	'method'=>'get',
)); ?>
        
        <table class="table table-bordered" style="width:50%;">
            <tr>
                <td width="5%" nowrap="nowrap"><?php echo $form->labelEx($model,'memo'); 
                echo Chtml::hiddenField("NoteInfoP[cust_id]", $custmodel->id);
                ?></td> 
                <td width="5%" nowrap="nowrap">
                     <?php echo $form->textField($model,'memo',array('maxlength'=>200,'size'=>100)); ?>
                </td> 
                <td><?php echo CHtml::submitButton('搜索',array('class' => 'btn btn-sm btn-primary')); ?></td>
            </tr> 
             
        </table>  
	 

<?php $this->endWidget(); ?>

</div><!-- search-form -->