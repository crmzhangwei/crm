<?php
/* @var $this NoteInfoController */
/* @var $model NoteInfo */
/* @var $form CActiveForm */
?>

<div class="form">

 

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
         <table class="table table-bordered"> 
            <tr>
                <td><?php echo $form->labelEx($model,'cust_id'); ?></td>
                <td>
                   <?php echo $form->textField($model,'cust_id'); ?>
		   <?php echo $form->error($model,'cust_id'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'eno'); ?></td>
                <td>
                    <?php echo $form->textField($model,'eno',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'eno'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'create_time'); ?></td>
                <td>
                   <?php echo $form->textField($model,'create_time'); ?>
		   <?php echo $form->error($model,'create_time'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'isvalid'); ?></td>
                <td>
                    <?php echo $form->textField($model,'isvalid',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'isvalid'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'iskey'); ?></td>
                <td>
                   <?php echo $form->textField($model,'iskey'); ?>
		   <?php echo $form->error($model,'iskey'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'next_contact'); ?></td>
                <td>
                    <?php echo $form->textField($model,'next_contact',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'next_contact'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'dial_id'); ?></td>
                <td>
                   <?php echo $form->textField($model,'dial_id'); ?>
		   <?php echo $form->error($model,'dial_id'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'cust_info'); ?></td>
                <td>
                    <?php echo $form->textField($model,'cust_info',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'cust_info'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'requirement'); ?></td>
                <td>
                   <?php echo $form->textField($model,'requirement'); ?>
		   <?php echo $form->error($model,'requirement'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'service'); ?></td>
                <td>
                    <?php echo $form->textField($model,'service',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'service'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'dissent'); ?></td>
                <td>
                   <?php echo $form->textField($model,'dissent'); ?>
		   <?php echo $form->error($model,'dissent'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'next_followup'); ?></td>
                <td>
                    <?php echo $form->textField($model,'next_followup',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'next_followup'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'memo'); ?></td>
                <td>
                   <?php echo $form->textField($model,'memo'); ?>
		   <?php echo $form->error($model,'memo'); ?>
                </td>
                <td></td>
                <td>
                     
                </td>
            </tr>
         </table>    

</div><!-- form -->