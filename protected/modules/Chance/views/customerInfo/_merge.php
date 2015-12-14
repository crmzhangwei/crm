<?php
/* @var $this CustomerInfoController */
/* @var $model CustomerInfo */
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'merge-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'action' => Yii::app()->controller->createUrl('merge'),
    'enableAjaxValidation' => false,
        ));
?> 
<script>
function changeCustType(obj){
    var value = $('#cust_type').val();
            if (value == 6) {
                 $("#tr_visit").show();  
            }  else { 
                $("#tr_visit").hide(); 
            }
}
</script>  

<table class="table table-bordered"> 
    <tr>
                <td width="10%">待合并客户</td>
                <td colspan="3">
                    <?php  
                        foreach($custlist as $cust){ 
                            echo '<input type="hidden" name="cust_id[]" value="'.$cust->id.'"/>';
                            echo $cust->cust_name.",";
                        } 
                    ?> 
                </td>
    </tr>
    <tr>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'cust_name'); ?></td>
        <td width="20%" nowrap="nowrap">
            <?php echo $form->dropDownList($model, "id", $cust_name) ?>   
        </td>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'shop_name'); ?></td>
        <td><?php echo $form->dropDownList($model, "shop_name", $shop_name) ?> </td>
    </tr>
    <tr>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'corp_name'); ?></td>
        <td width="20%" nowrap="nowrap">
            <?php echo $form->dropDownList($model, "corp_name", $corp_name) ?> 
        </td>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'shop_url'); ?></td>
        <td><?php echo $form->dropDownList($model, "shop_url", $shop_url) ?> </td>
    </tr>
    <tr>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'shop_addr'); ?></td>
        <td width="20%" nowrap="nowrap">
            <?php echo $form->dropDownList($model, "shop_addr", $shop_addr) ?> 
        </td>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'phone'); ?></td>
        <td><?php echo $form->dropDownList($model, "phone", $phones) ?> </td>
    </tr>
    <tr>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'phone2'); ?></td>
        <td width="20%" nowrap="nowrap">
            <?php echo $form->dropDownList($model, "phone2", $phones) ?> 
        </td>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'phone3'); ?></td>
        <td><?php echo $form->dropDownList($model, "phone3", $phones) ?> </td>
    </tr> 
    <tr>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'phone4'); ?></td>
        <td width="20%" nowrap="nowrap">
            <?php echo $form->dropDownList($model, "phone4", $phones) ?> 
        </td>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'phone5'); ?></td>
        <td><?php echo $form->dropDownList($model, "phone5", $phones) ?> </td>
    </tr>
    <tr>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'qq'); ?></td>
        <td width="20%" nowrap="nowrap">
            <?php echo $form->dropDownList($model, "qq", $qq) ?> 
        </td>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'mail'); ?></td>
        <td><?php echo $form->dropDownList($model, "mail", $mail) ?> </td>
    </tr>
    <tr>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'datafrom'); ?></td>
        <td width="20%" nowrap="nowrap">
            <?php echo $form->dropDownList($model, "datafrom", $datafrom) ?> 
        </td>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'category'); ?></td>
        <td><?php echo $form->dropDownList($model, "category", $category) ?> </td>
    </tr>
    <tr>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'cust_type'); ?></td>
        <td width="20%" nowrap="nowrap">
            <?php echo $form->dropDownList($model, "cust_type", $cust_type,array('id'=>'cust_type','onchange'=>'changeCustType(this)')) ?> 
        </td>
        <td width="10%" nowrap="nowrap"></td>
        <td> </td>
    </tr>
    <tr style="display:none;" id="tr_visit"> 
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'visit_date'); ?></td>
                <td><?php echo $form->textField($model,'visit_date',array('class'=>"Wdate", 'onClick'=>"WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})",'style'=>'height:30px;')); ?></td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'trans_user'); ?></td>
                <td> 
                  <?php echo $form->dropDownList($model, 'trans_user',$this->getTranUsers(), array('style' => "height:34px;")); ?>   
                </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model, 'iskey'); ?></td>
        <td> 
            <?php echo $form->radioButtonList($model, 'iskey', array('0' => '否', '1' => '是')); ?>
            <?php echo $form->error($model, 'iskey'); ?>
        </td>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'memo'); ?></td>
        <td width="20%" nowrap="nowrap">
            <?php echo $form->dropDownList($model, "memo", $memo) ?> 
        </td>  
    </tr> 
    <tr>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'next_time'); ?></td>
        <td width="20%" nowrap="nowrap">
            <?php echo $form->textField($model,'next_time',array('class'=>"Wdate", 'onClick'=>"WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})",'style'=>'height:30px;')); ?>
        </td>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'last_time'); ?></td>
        <td width="20%" nowrap="nowrap">
            <?php echo $form->textField($model,'last_time',array('class'=>"Wdate", 'onClick'=>"WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})",'style'=>'height:30px;')); ?>
        </td>
    </tr>
    <tr> 
        <td nowrap="nowrap"><?php echo $form->labelEx($model, 'creator'); ?></td>
        <td>
            <?php echo Yii::app()->user->name; ?>
        </td> 
        <td nowrap="nowrap"><?php echo $form->labelEx($model, 'create_time'); ?></td>
        <td><?php echo date('Y-m-d H:i:s',time()); ?>
        </td>
    </tr>
</table>

<div class="row buttons">
    <?php echo CHtml::submitButton('保存', array('class' => 'btn btn-sm btn-primary')); ?> 
</div> 

<?php $this->endWidget(); ?>

<script>
    if($('#cust_type').val()=="6"){
        $("#tr_visit").show();  
    }else{
        $("#tr_visit").hide();  
    }
</script>    
    