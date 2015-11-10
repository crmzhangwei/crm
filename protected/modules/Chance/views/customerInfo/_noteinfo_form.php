<?php
/* @var $this NoteInfoController */
/* @var $model NoteInfo */
/* @var $form CActiveForm */
?>
   
<div class="form"> 
    <font color="red"><?php echo $form->errorSummary($model); ?></font>
         <table class="table table-bordered" width="80%"> 
            <tr>
                <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model,'userid'); ?></td>
                <td width="20%" nowrap="nowrap">
                    <?php echo Yii::app()->session['user']['name'];?>
                    <?php echo $form->hiddenField($model, 'dial_id'); ?>
                    <?php echo $form->hiddenField($model, 'uid'); ?>
                    <?php echo $form->hiddenField($model, 'message_id'); ?>
                    <?php  echo CHtml::hiddenField('NoteInfoP[cust_id]',$custmodel->id) ?>
                    <?php echo $form->error($model,'eno'); ?>
                </td>
                <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model,'next_contact'); ?></td>
                <td> 
                    <?php echo $form->textField($model,'next_contact',array('class'=>"Wdate", 'onClick'=>"WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})",'style'=>'height:30px;')); ?>
                    <font color="red"><?php echo $form->error($model,'next_contact'); ?></font>
                </td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($custmodel,'cust_type'); ?></td>
                <td colspan="3"> 
                    <?php echo $form->dropDownList($custmodel, 'cust_type',$this->genCustTypeArray(), array('id'=>'cust_type','style' => "height:34px;",'onchange'=>'changeCustType(this)')); ?>
                    <?php echo $form->error($custmodel,'cust_type'); ?>
                </td> 
            </tr>
            <tr style="display:none;" id="tr_visit"> 
                <td nowrap="nowrap"><?php echo $form->labelEx($custmodel,'visit_date'); ?></td>
                <td><?php echo $form->textField($custmodel,'visit_date',array('class'=>"Wdate", 'onClick'=>"WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})",'style'=>'height:30px;')); ?></td>
                <td nowrap="nowrap"><?php echo $form->labelEx($custmodel,'trans_user'); ?></td>
                <td> 
                  <?php echo $form->dropDownList($custmodel, 'trans_user',$this->getTranUsers(), array('style' => "height:34px;")); ?>  
                  <font color="red"><?php echo $form->error($custmodel,'trans_user'); ?></font>
                </td>
            </tr>
            <tr style="display:none;" id="tr_abandon"> 
                <td nowrap="nowrap"><?php echo $form->labelEx($custmodel,'abandon_reason'); ?></td>
                <td colspan="3"><?php echo $form->textArea($custmodel,'abandon_reason',array('rows'=>3,'cols'=>50)); ?>
                   <font color="red"><?php echo $form->error($custmodel,'abandon_reason'); ?> </font>
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
 