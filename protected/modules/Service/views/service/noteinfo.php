<?php
/* @var $this NoteInfoController */
/* @var $model NoteInfo */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-info-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div class="form">  
         <table class="table table-bordered" width="90%">  
            <tr>
                <td><?php echo $form->labelEx($model,'iskey'); ?></td>
                <td> 
                   <?php echo $form->radioButtonList($model, 'iskey', array('0'=>'否','1'=> '是'));  ?> 
                </td>
                <td><?php echo $form->labelEx($model,'isvalid'); ?></td>
                <td>
                    <?php echo $form->radioButtonList($model, 'isvalid', array('0'=>'否','1'=> '是'));  ?> 
                </td>
            </tr>  
            <tr> 
                <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model,'next_contact'); ?></td>
                <td colspan="3">  
                    <?php echo date('Y-m-d H:i:s',$model->next_contact); ?>
                </td> 
            </tr> 
            <tr>  
                <td><?php echo $form->labelEx($model,'memo'); ?></td>
                <td colspan="3"> 
		  <?php echo $model->memo;?> 
                </td>
            </tr> 
         </table>    
</div><!-- form -->

<?php $this->endWidget();?>
 