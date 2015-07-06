<?php
/* @var $this newController */
/* @var $model ContractInfo */
/* @var $form CActiveForm */
?>

<div class="form">   
	<?php echo $form->errorSummary($contract); ?>
         <table class="table table-bordered"> 
            <tr>
                <td width="10%"  nowrap="nowrap"><?php echo $form->labelEx($contract,'service_limit'); ?></td>
                <td width="20%" nowrap="nowrap"> 
                   <?php echo $form->textField($contract,'service_limit'); ?>
		   <?php echo $form->error($contract,'service_limit'); ?>
                </td>
                <td width="10%"  nowrap="nowrap"><?php echo $form->labelEx($contract,'total_money'); ?></td>
                <td> 
                    <?php echo $form->textField($contract,'total_money'); ?>
                    <?php echo $form->error($contract,'total_money'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($contract,'pay_type'); ?></td>
                <td> 
                   <?php echo $form->textField($contract,'pay_type'); ?>
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
                <td> 
                    <?php echo $form->textField($contract,'promise'); ?>
		   <?php echo $form->error($contract,'promise'); ?>
                </td>
                <td><?php echo $form->labelEx($contract,'first_pay'); ?></td>
                <td> 
                    <?php echo $form->textField($contract,'first_pay'); ?>
                    <?php echo $form->error($contract,'first_pay'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($contract,'second_pay'); ?></td>
                <td> 
                    <?php echo $form->textField($contract,'second_pay'); ?>
		   <?php echo $form->error($contract,'second_pay'); ?>
                </td>
                <td><?php echo $form->labelEx($contract,'third_pay'); ?></td>
                <td> 
                    <?php echo $form->textField($contract,'third_pay'); ?>
                    <?php echo $form->error($contract,'third_pay'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($contract,'fourth_pay'); ?></td>
                <td colspan="3"> 
                    <?php echo $form->textField($contract,'fourth_pay'); ?>
		   <?php echo $form->error($contract,'fourth_pay'); ?>
                </td>
                 
            </tr>
            <tr>
                <td><?php echo $form->labelEx($contract,'comm_royalty'); ?></td>
                <td> 
                    <?php echo $form->textField($contract,'comm_royalty'); ?>
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
                    <?php echo $contract->creator; ?> 
                </td>
                <td><?php echo $form->labelEx($contract,'create_time'); ?></td>
                <td>
                   <?php echo $contract->create_time;?> 
                </td> 
            </tr>
         </table>    

</div><!-- form -->
<div class="row buttons">
		<?php echo CHtml::submitButton('保存',array('class' => 'btn btn-sm btn-primary')); ?>
    </div> 