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
        'action'=>Yii::app()->controller->createUrl($this->actionName, array('id'=>$model->id)),
	'enableAjaxValidation'=>false,
)); ?>
<div class="form"> 
	<?php echo $form->errorSummary($model); ?>
         <table class="table table-bordered" width="80%"> 
            <tr>
                <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model,'eno'); ?></td>
                <td width="20%" nowrap="nowrap">
                    <?php echo Yii::app()->session['user']['eno'];?>
                    <?php echo $form->hiddenField($model, 'dial_id'); ?>
                    <?php echo $form->hiddenField($model, 'message_id'); ?>
                    <?php  echo CHtml::hiddenField('NoteInfo[cust_id]',$custmodel->id) ?>
                    <?php echo $form->error($model,'eno'); ?>
                </td>
                <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model,'next_contact'); ?></td>
                <td> 
                    <?php echo $form->textField($model,'next_contact',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;')); ?>
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
                <td><?php echo $form->labelEx($model,'cust_info'); ?></td>
                <td> 
                    <?php echo $form->textArea($model,'cust_info',array('rows'=>3,'cols'=>30)); ?>
                    <?php echo $form->error($model,'cust_info'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'requirement'); ?></td>
                <td> 
                    <?php echo $form->textArea($model,'requirement',array('rows'=>3,'cols'=>30)); ?>
		   <?php echo $form->error($model,'requirement'); ?>
                </td>
            </tr>
            <tr> 
                <td><?php echo $form->labelEx($model,'service'); ?></td>
                <td> 
                    <?php echo $form->textArea($model,'service',array('rows'=>3,'cols'=>30)); ?>
                    <?php echo $form->error($model,'service'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'dissent'); ?></td>
                <td>
                   <?php echo $form->textArea($model,'dissent',array('rows'=>3,'cols'=>30)); ?>
		   <?php echo $form->error($model,'dissent'); ?>
                </td>
            </tr>
            <tr> 
                <td><?php echo $form->labelEx($model,'next_followup'); ?></td>
                <td>
                    <?php echo $form->textArea($model,'next_followup',array('rows'=>3,'cols'=>30)); ?>
                    <?php echo $form->error($model,'next_followup'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'memo'); ?></td>
                <td>
                  <?php echo $form->textArea($model,'memo',array('rows'=>3,'cols'=>30)); ?>
		   <?php echo $form->error($model,'memo'); ?>
                </td>
            </tr> 
         </table>    

</div><!-- form -->
<?php $this->endWidget();?>
<div class="row buttons">
		<?php echo CHtml::submitButton('保存',array('class' => 'btn btn-sm btn-primary')); ?>
    </div> 