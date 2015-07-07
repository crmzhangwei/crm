
<?php
/* @var $this newController */
/* @var $model CustomerInfo */
 

Yii::app()->clientScript->registerScript('baseinfo', "
function dial_ret(data){
  var obj = $.parseJSON(data);
  $('#NoteInfo_dial_id').val(obj.dial_id);
  bootbox.alert(obj.message);
}

function mail_ret(data){
 window.open('http://exmail.qq.com/login');  
}
function listen_ret(data){
 alert(data);
}
$('#btn_cancel').click(
            function(){
                
            }
        );
");
?> 
<script type="text/javascript">
function sendMessage(cust_id){ 
    public.dialog('发送短信', '<?= Yii::app()->createUrl('Service/service/message') ?>', {'cust_id':cust_id}, 900); 
}
function sendMail(cust_id){
    alert(cust_id);
    
}
</script> 
	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->errorSummary($note); ?>
        <?php echo $form->errorSummary($contract); ?>
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
                    <?php echo CHtml::ajaxButton("拔打电话", Yii::app()->createUrl('Service/service/dial',array('cust_id'=>$model->id)), array('success'=>'dial_ret'),array('class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom")) ?>
                    <?php echo CHtml::button("发送短信", array('onclick'=>'javascript:sendMessage('.$model->id.')','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom")) ?>
                    <?php echo $form->error($model,'phone'); ?>
                </td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'qq'); ?></td>
                <td>
                   <?php echo $form->textField($model,'qq',array('size'=>30,'maxlength'=>20)); ?>
		   <?php echo $form->error($model,'qq'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'mail'); ?></td>
                <td><?php echo $form->textField($model,'mail',array('size'=>60,'maxlength'=>50)); ?>
                    <?php echo CHtml::button("发邮件",array('onclick'=>'javascript:sendMail('.$model->id.')','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom")) ?>
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
                    <?php echo  $form->dropDownList($after, "cust_type", $this->getCustTypeArr()) ?>
                    <?php echo $form->error($after,'cust_type'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'eno'); ?></td>
                <td><?php echo $this->get_eno_text($model); ?>
		<?php echo $form->error($model,'eno'); ?></td>
            </tr>
            <tr> 
                <td nowrap="nowrap"><?php echo $form->labelEx($after,'assign_eno'); ?></td>
                <td><?php echo $this->get_assign_eno_text($after); ?></td>
                <td nowrap="nowrap"><?php echo $form->labelEx($after,'assign_time'); ?></td>
                <td>
                   <?php echo $after->assign_time; ?>  
                </td>
            </tr>
            <tr> 
                <td nowrap="nowrap"><?php echo $form->labelEx($after,'webchat'); ?></td>
                <td><?php echo $form->textField($after,'webchat'); ?></td>
                <td nowrap="nowrap"><?php echo $form->labelEx($after,'ww'); ?></td>
                <td><?php echo $form->textField($after,'ww'); ?></td>
            </tr>
            <tr> 
                <td nowrap="nowrap"><?php echo $form->labelEx($after,'next_time'); ?><br/><br/>
                <?php echo $form->labelEx($after,'last_time'); ?><br/><br/>
                是否重点
                </td>
                <td> <?php echo $model->next_time;?> <br/><br/>
                <?php echo $model->last_time;?><br/><br/>
                <?php echo $model->iskey?'是':'否'; ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'memo'); ?></td>
                <td>
                <?php echo $form->textArea($model,'memo',array('rows'=>3,'cols'=>50)); ?>
		<?php echo $form->error($model,'memo'); ?>
                </td> 
            </tr>
            <tr> 
                <td nowrap="nowrap"><?php echo $form->labelEx($after,'creator'); ?></td>
                <td>
                   <?php echo $after->creator; ?>  
                </td> 
                <td nowrap="nowrap"><?php echo $form->labelEx($after,'create_time'); ?></td>
                <td><?php echo $model->create_time; ?> </td>
            </tr>
        </table>
<div class="row buttons">
		<?php echo CHtml::submitButton('保存',array('class' => 'btn btn-sm btn-primary')); ?> 
    </div> 