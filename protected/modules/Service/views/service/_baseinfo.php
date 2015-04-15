
<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */
 

Yii::app()->clientScript->registerScript('baseinfo', "
function dial_ret(data){
 alert(data);
}
function message_ret(data){
 alert(data);
}
function mail_ret(data){
 alert(data);
}

");
?> 
<p class="note">Fields with <span class="required">*</span> are required.</p> 
	<?php echo $form->errorSummary($model); ?> 
        <table class="table table-bordered"> 
            <tr>
                <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model,'cust_name'); ?></td>
                <td width="20%" nowrap="nowrap">
                    <?php echo $model->cust_name; ?>
                    <?php echo $form->error($model,'cust_name'); ?>
                </td>
                <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model,'shop_name'); ?></td>
                <td><?php echo $model->shop_name; ?>
		<?php echo $form->error($model,'shop_name'); ?></td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'corp_name'); ?></td>
                <td>
                    <?php echo $model->corp_name ?>
                    <?php echo $form->error($model,'corp_name'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'shop_url'); ?></td>
                <td><?php echo $model->shop_url; ?>
		<?php echo $form->error($model,'shop_url'); ?></td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'shop_addr'); ?></td>
                <td>
                    <?php echo $model->shop_addr; ?>
                    <?php echo $form->error($model,'shop_addr'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'phone'); ?></td>
                <td><?php echo Utils::hidePhone($model->phone); ?>
                    <?php echo CHtml::ajaxButton("拔打电话", "index.php?r=Service/service/dial&cust_id=".$model->id, array('success'=>'dial_ret')) ?>
                <?php echo CHtml::ajaxButton("发送短信", "index.php?r=Service/service/message&cust_id=".$model->id, array('success'=>'message_ret')) ?>
		<?php echo $form->error($model,'phone'); ?>
                </td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'qq'); ?></td>
                <td>
                   <?php  echo Utils::hideQq($model->qq);  ?>
		   <?php echo $form->error($model,'qq'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'mail'); ?></td>
                <td><?php  echo Utils::hideEmail($model->mail);  ?>
                    <?php echo CHtml::ajaxButton("发邮件", "index.php?r=Service/service/mail&cust_id=".$model->id, array('success'=>'mail_ret')) ?>
		<?php echo $form->error($model,'mail'); ?></td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'datafrom'); ?></td>
                <td>
                   <?php echo $model->datafrom; ?>
		<?php echo $form->error($model,'datafrom'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'category'); ?></td>
                <td>
                    <?php echo  $form->dropDownList($model, "category", $this->getCategoryArr()) ?>
		<?php echo $form->error($model,'category'); ?></td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'cust_type'); ?></td>
                <td> 
                    <?php echo  $form->dropDownList($model, "cust_type", $this->getCustTypeArr()) ?>
                    <?php echo $form->error($model,'cust_type'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'eno'); ?></td>
                <td><?php echo $model->eno; ?>
		<?php echo $form->error($model,'eno'); ?></td>
            </tr>
            <tr> 
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'assign_eno'); ?></td>
                <td><?php echo $model->assign_eno; ?></td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'assign_time'); ?></td>
                <td>
                   <?php echo $model->assign_time; ?>  
                </td>
            </tr>
            
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'next_time'); ?></td>
                <td>
                    <?php echo $form->textField($model,'next_time',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;')); ?>
                    <?php echo $form->error($model,'next_time'); ?></td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'memo'); ?></td>
                <td>
                <?php echo $form->textArea($model,'memo',array('rows'=>3,'cols'=>30)); ?>
		<?php echo $form->error($model,'memo'); ?>
                </td> 
            </tr>
            <tr> 
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'creator'); ?></td>
                <td>
                   <?php echo $model->user['eno']; ?>  
                </td> 
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'create_time'); ?></td>
                <td><?php echo $model->create_time; ?>
		<?php echo $form->error($model,'create_time'); ?></td>
            </tr>
        </table>
<div class="row buttons">
		<?php echo CHtml::submitButton('保存'); ?>
    </div> 