<?php
/* @var $this NoteInfoController */
/* @var $model NoteInfo */
/* @var $form CActiveForm */
?>

<div class="form"> 
	<?php echo $form->errorSummary($model); ?>
         <table class="table table-bordered" width="80%"> 
            <tr>
                <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model,'userid'); ?></td>
                <td width="20%" nowrap="nowrap">
                   <?php  echo $loginuser->name;  ?> 
                    <?php echo $form->hiddenField($model, 'dial_id'); ?>
                    <?php echo $form->hiddenField($model, 'cust_id'); ?>
                    <?php echo $form->hiddenField($model, 'message_id'); ?> 
                </td>
                <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model,'next_contact'); ?></td>
                <td> 
                    <?php echo $form->textField($model,'next_contact',array('class'=>"Wdate", 'onClick'=>"WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})",'style'=>'height:30px;')); ?>
                    <?php echo $form->error($model,'next_contact'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'iskey'); ?></td>
                <td> 
                   <?php echo $form->radioButtonList($model, 'iskey', array('0'=>'否','1'=> '是'));  ?>
		   <?php echo $form->error($model,'iskey'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'isvalid'); ?></td>
                <td>
                    <?php echo $form->radioButtonList($model, 'isvalid', array('0'=>'否','1'=> '是'));  ?>
                    <?php echo $form->error($model,'isvalid'); ?>
                </td>
            </tr> 
             
            <tr>  
                <td><?php echo $form->labelEx($model,'memo'); ?></td>
                <td colspan="3">
                  <?php echo $form->textArea($model,'memo',array('rows'=>3,'cols'=>90)); ?>
		   <?php echo $form->error($model,'memo'); ?>
                </td>
            </tr> 
         </table>    

</div><!-- form -->
<div class="row buttons">
		<?php echo CHtml::submitButton('保存',array('class' => 'btn btn-sm btn-primary')); ?>
    </div> 