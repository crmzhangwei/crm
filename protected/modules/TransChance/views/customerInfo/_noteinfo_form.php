<?php
/* @var $this NoteInfoController */
/* @var $model NoteInfo */
/* @var $form CActiveForm */
?>
   
<div class="form"> 
    <font color="red">
        <?php echo $form->errorSummary($model); 
        echo $form->errorSummary($contract);
        ?>
    </font>
         <table class="table table-bordered" width="80%"> 
            <tr>
                <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model,'userid'); ?></td>
                <td width="20%" nowrap="nowrap">
                    <?php echo Yii::app()->session['user']['name'];?>
                    <?php echo $form->hiddenField($model, 'dial_id'); ?>
                    <?php echo $form->hiddenField($model, 'uid'); ?>
                    <?php echo $form->hiddenField($model, 'message_id'); ?>
                    <?php  echo CHtml::hiddenField('NoteInfoP[cust_id]',$custmodel->id) ?> 
                </td>
                <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model,'next_contact'); ?></td>
                <td> 
                    <?php echo $form->textField($model,'next_contact',array('class'=>"Wdate", 'onClick'=>"WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})",'style'=>'height:30px;')); ?>
                    <font color="red"><?php echo $form->error($model,'next_contact'); ?></font>
                </td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($trans_model,'cust_type'); ?></td>
                <td colspan="3"> 
                    <?php echo $form->dropDownList($trans_model, 'cust_type',$this->genCustTypeArray(), array('id'=>'cust_type','style' => "height:34px;",'onchange'=>'changeCustType(this)')); ?>
                    <?php echo $form->error($trans_model,'cust_type'); ?>
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
                  <?php echo $form->textArea($model,'memo',array('rows'=>3,'cols'=>30)); ?>
		   <?php echo $form->error($model,'memo'); ?>
                </td>
            </tr> 
         </table>    

</div><!-- form -->
<hr>
<table class="table table-bordered" id="tb_contract" style="display:none;">
            <tr>
                <td width="10%"  nowrap="nowrap"><?php echo $form->labelEx($contract,'service_limit'); ?></td>
                <td width="20%" nowrap="nowrap"> 
                    <?php echo $form->textField($contract,'service_limit',array('size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->hiddenField($contract, 'id'); ?>
		    <?php echo $form->error($contract,'service_limit'); ?>
                </td>
                <td width="10%"  nowrap="nowrap"><?php echo $form->labelEx($contract,'total_money'); ?></td>
                <td> 
                    <?php echo $form->textField($contract,'total_money',array('class'=>'col-md-3','size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error($contract,'total_money'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($contract,'pay_type'); ?></td>
                <td> 
                    <?php echo $form->textField($contract,'pay_type',array('size'=>50,'maxlength'=>50)); ?>
		   <?php echo $form->error($contract,'pay_type'); ?>
                </td>
                <td><?php echo $form->labelEx($contract,'pay_time'); ?></td>
                <td> 
                    <?php echo $form->textField($contract,'pay_time',array('class'=>"Wdate", 'onClick'=>"WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})",'style'=>'height:30px;')); ?> 
                    <?php echo $form->error($contract,'pay_time'); ?>
                </td>
            </tr> 
            <tr>
                <td><?php echo $form->labelEx($contract,'promise'); ?></td>
                <td colspan="3"> 
                    <?php echo $form->textArea($contract,'promise',array('rows'=>3,'cols'=>50)); ?>
		    <?php echo $form->error($contract,'promise'); ?>
                </td> 
            </tr>
            <tr>
                <td><?php echo $form->labelEx($contract,'first_pay'); ?></td>
                <td> 
                    <?php echo $form->textField($contract,'first_pay',array('size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error($contract,'first_pay'); ?>
                </td>
                <td><?php echo $form->labelEx($contract,'second_pay'); ?></td>
                <td> 
                    <?php echo $form->textField($contract,'second_pay',array('size'=>50,'maxlength'=>50)); ?>
		    <?php echo $form->error($contract,'second_pay'); ?>
                </td> 
            </tr>
            <tr>
                <td><?php echo $form->labelEx($contract,'third_pay'); ?></td>
                <td> 
                    <?php echo $form->textField($contract,'third_pay',array('size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error($contract,'third_pay'); ?>
                </td>
                <td><?php echo $form->labelEx($contract,'fourth_pay'); ?></td>
                <td> 
                    <?php echo $form->textField($contract,'fourth_pay',array('size'=>50,'maxlength'=>50)); ?>
		    <?php echo $form->error($contract,'fourth_pay'); ?>
                </td> 
            </tr>
            <tr>
                <td><?php echo $form->labelEx($contract,'comm_royalty'); ?></td>
                <td> 
                    <?php echo $form->textField($contract,'comm_royalty',array('size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error($contract,'comm_royalty'); ?>
                </td>
                <td><?php echo $form->labelEx($contract,'comm_pay_time'); ?></td>
                <td> 
                    <?php echo $form->textField($contract,'comm_pay_time',array('class'=>"Wdate", 'onClick'=>"WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})",'style'=>'height:30px;')); ?>
		   <?php echo $form->error($contract,'comm_pay_time'); ?>
                </td>
                
            </tr>
            <tr>
                <td><?php echo $form->labelEx($contract,'creator'); ?></td>
                <td>
                    <?=$user->username?>  
                </td>
                <td><?php echo $form->labelEx($contract,'create_time'); ?></td>
                <td> 
		   <?php echo date("Y-m-d H:i:s",time()); ?> 
                </td> 
            </tr>
    </table> 
<div class="row buttons">
		<?php echo CHtml::submitButton('保存',array('class' => 'btn btn-sm btn-primary')); ?>
    </div> 
 