<?php
/* @var $this NoteInfoController */
/* @var $model NoteInfo */
/* @var $form CActiveForm */
?>

<div class="form">   
	<?php echo $form->errorSummary($model); ?>
         <table class="table table-bordered"> 
            <tr>
                <td width="10%"  nowrap="nowrap"><?php echo $form->labelEx($model,'contract[service_limit]'); ?></td>
                <td width="20%" nowrap="nowrap">
                   <?php echo $model->contract['service_limit']; ?>
		   <?php echo $form->error($model,'contract[service_limit]'); ?>
                </td>
                <td width="10%"  nowrap="nowrap"><?php echo $form->labelEx($model,'contract[total_money]'); ?></td>
                <td>
                    <?php echo $model->contract['total_money']; ?>
                    <?php echo $form->error($model,'contract[total_money]'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'contract[pay_type]'); ?></td>
                <td>
                   <?php echo $model->contract['pay_type']; ?>
		   <?php echo $form->error($model,'contract[pay_type]'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'contract[pay_time]'); ?></td>
                <td>
                    <?php echo $model->contract['pay_time']; ?>
                    <?php echo $form->error($model,'contract[pay_time]'); ?>
                </td>
            </tr> 
            <tr>
                <td><?php echo $form->labelEx($model,'contract[promise]'); ?></td>
                <td>
                   <?php echo $model->contract['promise']; ?>
		   <?php echo $form->error($model,'contract[promise]'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'contract[first_pay]'); ?></td>
                <td>
                    <?php echo $model->contract['first_pay']; ?>
                    <?php echo $form->error($model,'contract[first_pay]'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'contract[second_pay]'); ?></td>
                <td>
                   <?php echo $model->contract['second_pay']; ?>
		   <?php echo $form->error($model,'contract[second_pay]'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'contract[third_pay]'); ?></td>
                <td>
                    <?php echo $model->contract['third_pay']; ?>
                    <?php echo $form->error($model,'contract[third_pay]'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'contract[fourth_pay]'); ?></td>
                <td>
                   <?php echo $model->contract['fourth_pay']; ?>
		   <?php echo $form->error($model,'contract[fourth_pay]'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'contract[comm_royalty]'); ?></td>
                <td>
                    <?php echo $model->contract['comm_royalty']; ?>
                    <?php echo $form->error($model,'contract[comm_royalty]'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'contract[comm_pay_time]'); ?></td>
                <td>
                   <?php echo $model->contract['comm_pay_time']; ?>
		   <?php echo $form->error($model,'contract[comm_pay_time]'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'contract[creator]'); ?></td>
                <td>
                    <?php echo $model->contract['user']['eno']; ?>
                    <?php echo $form->error($model,'contract[creator]'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'contract[create_time]'); ?></td>
                <td>
                   <?php echo $model->contract['create_time'];?>
		   <?php echo $form->error($model,'contract[create_time]'); ?>
                </td>
                <td></td>
                <td>
                    
                </td>
            </tr>
         </table>    

</div><!-- form -->