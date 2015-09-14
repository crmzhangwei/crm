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
    window.open('http://exmail.qq.com/login');  
}
function dial(cust_id,seq){
    var dialid=$('#NoteInfo_dial_id').val();
    $uid = $('#NoteInfo_uid').val();
    if(dialid>0&&uid==''){
        bootbox.alert('请先获取通话时长!');
        return ;
    }
    $.getJSON('index.php?r=Service/service/dial&cust_id='+cust_id+"&seq="+seq,function(obj){
         $('#NoteInfo_dial_id').val(obj.dial_id); 
         bootbox.alert(obj.message);
    });
}
function changeCustType(obj){
    var value = $('#cust_type').val();
            if (value == 6) {
                 $("#tr_visit").show(); 
                 $("#tr_abandon").hide();
            }else if (value ==9) {
                $("#tr_abandon").show();
                $("#tr_visit").hide(); 
            } else {
                $("#tr_abandon").hide();
                $("#tr_visit").hide(); 
            }
}
function popUid(){
    var dialid = $('#NoteInfo_dial_id').val(); 
    if(dialid=='0'||dialid==''){
        bootbox.alert('未拔打电话');
        return;
    }
    $uid = $('#NoteInfo_uid').val();
    if($uid!=''){
        bootbox.alert('已经获取');
        return ;
    }
    $.getJSON('index.php?r=Service/service/dialUid&dial_id='+dialid,function(obj){
       
        if(obj&&obj.uid!=''){
            $('#NoteInfo_uid').val(obj.uid); 
            bootbox.alert('获取成功');
        }else{
            bootbox.alert('稍等片刻重新获取');
        }
        
    });
}
</script> 
 
	<?php echo $form->errorSummary($model);  ?>
       
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
                           echo CHtml::button("拔打电话", array('onclick'=>'javascript:dial('.$model->id.',1)','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));  
                           echo "&nbsp;";
                           echo CHtml::button("获取通话时长",array('onclick'=>'javascript:popUid()','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));  
                           echo "&nbsp;";
                           echo CHtml::button("发送短信", array('onclick'=>'javascript:sendMessage('.$model->id.',1)','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));
                    ?>  
                    <?php 
                    if(!empty($model->phone2)){
                        echo "&nbsp;&nbsp;";
                        echo Utils::hidePhone($model->phone2);echo "&nbsp;";
                        echo CHtml::button("拔打电话", array('onclick'=>'javascript:dial('.$model->id.',2)','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));  
                        echo "&nbsp;";
                        echo CHtml::button("发送短信", array('onclick'=>'javascript:sendMessage('.$model->id.',2)','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));
                    } 
                    ?> 
                    <?php 
                    if(!empty($model->phone3)){
                        echo "<br/><br/>";
                        echo Utils::hidePhone($model->phone3);echo "&nbsp;";
                        echo CHtml::button("拔打电话", array('onclick'=>'javascript:dial('.$model->id.',3)','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));  
                        echo "&nbsp;";
                        echo CHtml::button("发送短信", array('onclick'=>'javascript:sendMessage('.$model->id.',3)','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));
                    } 
                    ?> 
                   <?php 
                    if(!empty($model->phone4)){
                        echo "&nbsp;&nbsp;";
                        echo Utils::hidePhone($model->phone4);
                        echo CHtml::button("拔打电话", array('onclick'=>'javascript:dial('.$model->id.',4)','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));  
                        echo "&nbsp;";
                        echo CHtml::button("发送短信", array('onclick'=>'javascript:sendMessage('.$model->id.',4)','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));
                    } 
                    ?> 
                    <?php 
                    if(!empty($model->phone5)){
                        echo "<br/><br/>";
                        echo Utils::hidePhone($model->phone5);
                        echo CHtml::button("拔打电话", array('onclick'=>'javascript:dial('.$model->id.',5)','class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"));  
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
                    <?php echo $form->hiddenField($model,"cust_type");?>
                    <?php  $custTypes = $this->genCustTypeArray();
                            echo $custTypes[$model->cust_type];?>
                    <?php echo $form->error($model,'cust_type'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'eno'); ?></td>
                <td><?php echo $this->get_eno_text($model); ?>
		<?php echo $form->error($model,'eno'); ?></td>
            </tr>
            <tr style="display:none;" id="tr_visit"> 
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'visit_date'); ?></td>
                <td><?php echo $form->textField($model,'visit_date',array('class'=>"Wdate",'style'=>'height:30px;')); ?></td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'trans_user'); ?></td>
                <td> 
                  <?php echo $model->trans_user; ?>   
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
                    <?php echo $model->last_time ; ?><br/><br/>
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

<div class="row buttons">
		<?php echo CHtml::submitButton('保存',array('class' => 'btn btn-sm btn-primary')); ?> 
    </div> 