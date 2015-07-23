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
function sendMessage(cust_id,seq){ 
    public.dialog('发送短信', '<?= Yii::app()->createUrl('Service/service/message') ?>', {'cust_id':cust_id,'seq':seq}, 900); 
}
function sendMail(cust_id){
    alert(cust_id);
    
}
function changeCustType(obj){
   if(obj.value=='17'){
       $("#tb_contract").show(); 
       $("#tr_abandon").hide();
   }else if(obj.value=='18'){
       $("#tr_abandon").show(); 
       $("#tb_contract").hide();
   }else{
       $("#tr_abandon").hide(); 
       $("#tb_contract").hide();
   }
}
</script> 
 
	<?php echo $form->errorSummary($model); 
               echo $form->errorSummary($contract);  
        ?>
       
        <table class="table table-bordered"> 
            <tr>
                <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model,'cust_name'); ?></td>
                <td width="20%" nowrap="nowrap">
                    <?php echo $form->textField($model,'cust_name',array('maxlength'=>100,'size'=>30))?>
                    <?php echo $form->error($model,'cust_name'); ?>
                </td>
                <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model,'shop_name'); ?></td>
                <td><?php echo $form->textField($model,'shop_name',array('maxlength'=>100,'size'=>30)); ?>
		<?php echo $form->error($model,'shop_name'); ?></td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'corp_name'); ?></td>
                <td>
                    <?php echo $form->textField($model,'corp_name',array('maxlength'=>100,'size'=>30)); ?>
                    <?php echo $form->error($model,'corp_name'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'shop_url'); ?></td>
                <td><?php echo $form->textField($model,'shop_url',array( 'maxlength'=>100,'size'=>30,)); ?>
		<?php echo $form->error($model,'shop_url'); ?></td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'shop_addr'); ?></td>
                <td>
                   <?php echo $form->textField($model,'shop_addr',array('size'=>30,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'shop_addr'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'phone'); ?></td>
                <td>
                    <?php echo Utils::hidePhone($model->phone);echo "&nbsp;"; 
                           echo CHtml::ajaxButton("拔打电话", Yii::app()->createUrl('Service/service/dial',array('cust_id'=>$model->id,'seq'=>'1')), array('success'=>'dial_ret'),array('class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));  
                           echo "&nbsp;";
                           echo CHtml::button("发送短信", array('onclick'=>'javascript:sendMessage('.$model->id.',1)','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));
                    ?>  
                    <?php 
                    if(!empty($model->phone2)){
                        echo "&nbsp;&nbsp;";
                        echo Utils::hidePhone($model->phone2);echo "&nbsp;";
                        echo CHtml::ajaxButton("拔打电话", Yii::app()->createUrl('Service/service/dial',array('cust_id'=>$model->id,'seq'=>'2')), array('success'=>'dial_ret'),array('class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));
                        echo "&nbsp;";
                        echo CHtml::button("发送短信", array('onclick'=>'javascript:sendMessage('.$model->id.',2)','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));
                    } 
                    ?> 
                    <?php 
                    if(!empty($model->phone3)){
                        echo "<br/><br/>";
                        echo Utils::hidePhone($model->phone3);echo "&nbsp;";
                        echo CHtml::ajaxButton("拔打电话", Yii::app()->createUrl('Service/service/dial',array('cust_id'=>$model->id,'seq'=>'3')), array('success'=>'dial_ret'),array('class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));
                        echo "&nbsp;";
                        echo CHtml::button("发送短信", array('onclick'=>'javascript:sendMessage('.$model->id.',3)','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));
                    } 
                    ?> 
                   <?php 
                    if(!empty($model->phone4)){
                        echo "&nbsp;&nbsp;";
                        echo Utils::hidePhone($model->phone4);
                        echo CHtml::ajaxButton("拔打电话", Yii::app()->createUrl('Service/service/dial',array('cust_id'=>$model->id,'seq'=>'4')), array('success'=>'dial_ret'),array('class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));
                        echo "&nbsp;";
                        echo CHtml::button("发送短信", array('onclick'=>'javascript:sendMessage('.$model->id.',4)','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));
                    } 
                    ?> 
                    <?php 
                    if(!empty($model->phone5)){
                        echo "<br/><br/>";
                        echo Utils::hidePhone($model->phone5);
                        echo CHtml::ajaxButton("拔打电话", Yii::app()->createUrl('Service/service/dial',array('cust_id'=>$model->id,'seq'=>'5')), array('success'=>'dial_ret'),array('class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));
                        echo "&nbsp;";
                        echo CHtml::button("发送短信", array('onclick'=>'javascript:sendMessage('.$model->id.',5)','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));
                    } 
                    ?>
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
                <td> 
                    <?php echo $form->textField($model,'mail',array('size'=>60,'maxlength'=>50)); ?>
                    <?php echo CHtml::button("发邮件",array('onclick'=>'javascript:sendMail('.$model->id.')','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom")) ?>
		    <?php echo $form->error($model,'mail'); ?></td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'datafrom'); ?></td>
                <td>
                  <?php echo $form->textField($model,'datafrom',array('size'=>30,'maxlength'=>100)); ?>
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
                    <?php echo $form->dropDownList($trans_model, 'cust_type',$this->genCustTypeArray(), array('id'=>'cust_type','style' => "height:34px;",'onchange'=>'changeCustType(this)')); ?>
                    <?php echo $form->error($trans_model,'cust_type'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'eno'); ?></td>
                <td><?php echo $this->get_eno_text($model); ?>
		<?php echo $form->error($model,'eno'); ?></td>
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
                <td><?php echo $this->get_assign_eno_text($model); ?></td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'assign_time'); ?></td>
                <td>
                   <?php echo $model->assign_time; ?>  
                </td>
            </tr> 
            <tr> 
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'next_time'); ?><br/><br/>最后联系时间<br/><br/>是否重点</td>
                <td>
                    <?php echo $model->next_time; ?><br/><br/>
                    <?php echo $model->last_time; ?><br/><br/>
                    <?php echo $model->iskey?'是':'否'; ?>
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