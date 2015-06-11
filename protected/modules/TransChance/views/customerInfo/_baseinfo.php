<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */
 

Yii::app()->clientScript->registerScript('baseinfo', "
function dial_ret(data){
  var obj = $.parseJSON(data);
  $('#NoteInfo_dial_id').val(obj.dial_id);
  bootbox.alert(obj.message);
}

function mail_ret(data){
 alert(data);
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
function changeCustType(obj){
   if(obj.value=='6'){
       $("#tr_visit").show();
       $("#tb_contract").show();
       $("#tr_abandon").hide();
   }else if(obj.value=='8'){
       $("#tr_abandon").show();
       $("#tr_visit").hide();
       $("#tb_contract").hide();
   }
}
</script> 
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-info-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
        'action'=>Yii::app()->controller->createUrl($this->actionName, array('id'=>$model->id)),
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
       
        <table class="table table-bordered"> 
            <tr>
                <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model,'cust_name'); ?></td>
                <td width="20%" nowrap="nowrap">
                    <?php echo $form->textField($model,'cust_name',array('class'=>'col-md-6','maxlength'=>100))?>
                    <?php echo $form->error($model,'cust_name'); ?>
                </td>
                <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model,'shop_name'); ?></td>
                <td><?php echo $form->textField($model,'shop_name',array('class'=>'col-md-3','maxlength'=>100)); ?>
		<?php echo $form->error($model,'shop_name'); ?></td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'corp_name'); ?></td>
                <td>
                    <?php echo $form->textField($model,'corp_name',array('class'=>'col-md-3','maxlength'=>100)); ?>
                    <?php echo $form->error($model,'corp_name'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'shop_url'); ?></td>
                <td><?php echo $form->textField($model,'shop_url',array('class'=>'col-md-3','maxlength'=>100)); ?>
		<?php echo $form->error($model,'shop_url'); ?></td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'shop_addr'); ?></td>
                <td>
                   <?php echo $form->textField($model,'shop_addr',array('class'=>'col-md-3','maxlength'=>100)); ?>
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
                  <?php echo Utils::hideQq($model->qq); ?>
		   <?php echo $form->error($model,'qq'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'mail'); ?></td>
                <td><?php echo Utils::hideEmail($model->mail); ?>
                    <?php echo CHtml::button("发邮件",array('onclick'=>'javascript:sendMail('.$model->id.')','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom")) ?>
		    <?php echo $form->error($model,'mail'); ?></td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'datafrom'); ?></td>
                <td>
                  <?php echo $form->textField($model,'datafrom',array('class'=>'col-md-6','maxlength'=>100)); ?>
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
                    <?php echo $form->dropDownList($model, 'cust_type',$this->genCustTypeArray(), array('id'=>'cust_type','style' => "height:34px;",'onchange'=>'changeCustType(this)')); ?>
                    <?php echo $form->error($model,'cust_type'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'eno'); ?></td>
                <td><?php echo $model->eno; ?>
		<?php echo $form->error($model,'eno'); ?></td>
            </tr>
            <tr style="display:none;" id="tr_visit"> 
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'visit_date'); ?></td>
                <td><?php echo $form->textField($model,'visit_date',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;')); ?></td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'trans_user'); ?></td>
                <td>
                  <?php echo $form->textField($model,'trans_user',array('class'=>'col-md-3','maxlength'=>100)); ?>
                </td>
            </tr>
            <tr style="display:none;" id="tr_abandon"> 
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'abandon_reason'); ?></td>
                <td><?php echo $form->textArea($model,'abandon_reason',array('rows'=>3,'cols'=>50)); ?></td>
                <td nowrap="nowrap"></td>
                <td> 
                </td>
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
                <?php echo $form->textArea($model,'memo',array('rows'=>3,'cols'=>50)); ?>
		<?php echo $form->error($model,'memo'); ?>
                </td> 
            </tr>
            <tr> 
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'creator'); ?></td>
                <td>
		<?=$user->username?>
                </td> 
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'create_time'); ?></td>
                <td><?php echo $model->create_time; ?>
		 </td>
            </tr>
        </table>
<hr>
    <table class="table table-bordered" id="tb_contract" style="display:none;">
            <tr>
                <td width="10%"  nowrap="nowrap"><?php echo $form->labelEx($model,'contract[service_limit]'); ?></td>
                <td width="20%" nowrap="nowrap"> 
                    <?php echo $form->textField($model,'contract[service_limit]',array('size'=>50,'maxlength'=>50)); ?>
		    <?php echo $form->error($model,'contract[service_limit]'); ?>
                </td>
                <td width="10%"  nowrap="nowrap"><?php echo $form->labelEx($model,'contract[total_money]'); ?></td>
                <td> 
                    <?php echo $form->textField($model,'contract[total_money]',array('class'=>'col-md-3','size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error($model,'contract[total_money]'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'contract[pay_type]'); ?></td>
                <td> 
                    <?php echo $form->textField($model,'contract[pay_type]',array('size'=>50,'maxlength'=>50)); ?>
		   <?php echo $form->error($model,'contract[pay_type]'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'contract[pay_time]'); ?></td>
                <td> 
                    <?php echo $form->textField($model,'contract[pay_time]',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;')); ?> 
                    <?php echo $form->error($model,'contract[pay_time]'); ?>
                </td>
            </tr> 
            <tr>
                <td><?php echo $form->labelEx($model,'contract[promise]'); ?></td>
                <td colspan="3"> 
                    <?php echo $form->textArea($model,'contract[promise]',array('rows'=>3,'cols'=>50)); ?>
		    <?php echo $form->error($model,'contract[promise]'); ?>
                </td> 
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'contract[first_pay]'); ?></td>
                <td> 
                    <?php echo $form->textField($model,'contract[first_pay]',array('size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error($model,'contract[first_pay]'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'contract[second_pay]'); ?></td>
                <td> 
                    <?php echo $form->textField($model,'contract[second_pay]',array('size'=>50,'maxlength'=>50)); ?>
		    <?php echo $form->error($model,'contract[second_pay]'); ?>
                </td> 
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'contract[third_pay]'); ?></td>
                <td> 
                    <?php echo $form->textField($model,'contract[third_pay]',array('size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error($model,'contract[third_pay]'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'contract[fourth_pay]'); ?></td>
                <td> 
                    <?php echo $form->textField($model,'contract[fourth_pay]',array('size'=>50,'maxlength'=>50)); ?>
		    <?php echo $form->error($model,'contract[fourth_pay]'); ?>
                </td> 
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'contract[comm_royalty]'); ?></td>
                <td> 
                    <?php echo $form->textField($model,'contract[comm_royalty]',array('size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error($model,'contract[comm_royalty]'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'contract[comm_pay_time]'); ?></td>
                <td> 
                    <?php echo $form->textField($model,'contract[comm_pay_time]',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;')); ?>
		   <?php echo $form->error($model,'contract[comm_pay_time]'); ?>
                </td>
                
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'contract[creator]'); ?></td>
                <td>
                    <?=$user->username?> 
                </td>
                <td><?php echo $form->labelEx($model,'contract[create_time]'); ?></td>
                <td> 
		   <?php echo date("Y-m-d",time()); ?>
                </td> 
            </tr>
    </table>
<?php $this->endWidget();?>
<div class="row buttons">
		<?php echo CHtml::submitButton('保存',array('class' => 'btn btn-sm btn-primary')); ?> 
    </div> 