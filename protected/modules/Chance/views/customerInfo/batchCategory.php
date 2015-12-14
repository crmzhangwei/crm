<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */

$this->breadcrumbs = array(
    '我的机会' => array('todaylist'),
    '批量分类',
);

$this->menu = array(
);
?>

<h1>批量分类</h1>

 <?php
/* @var $this CustomerInfoController */
/* @var $model CustomerInfo */
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'batchCategory-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'action' => Yii::app()->controller->createUrl('batchCategory'),
    'htmlOptions'=>array('onsubmit'=>'return beforeSubmit()'),
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
function beforeSubmit(){
    var value = $('#cust_type').val();
    if (value == 6) {
        $visitdate = $("#id_visit_date").val();
        $transuser = $("#id_trans_user").val();
        if($visitdate==''||$transuser==''){
            alert('请选择到访时间和成交师');
            return false;
        }
    }
    return true;
}
</script>  

<table class="table table-bordered"> 
    <tr>
                <td width="10%">待分类客户</td>
                <td colspan="3">
                    <?php  
                        foreach($custlist as $cust){ 
                            echo '<input type="hidden" name="cust_id[]" value="'.$cust->id.'"/>';
                            echo $cust->cust_name."【".$cust->cust_type."类】,";
                        } 
                    ?> 
                </td> 
    </tr> 
    <tr>
        <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model, 'cust_type'); ?></td>
        <td width="20%" nowrap="nowrap" colspan="2">
            <?php echo $form->dropDownList($model, "cust_type", $custtype,array('id'=>'cust_type','onchange'=>'changeCustType(this)')) ?> 
        </td>
        <td></td>
    </tr>
    <tr style="display:none;" id="tr_visit"> 
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'visit_date'); ?></td>
                <td><?php echo $form->textField($model,'visit_date',array('id'=>'id_visit_date','class'=>"Wdate", 'onClick'=>"WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})",'style'=>'height:30px;')); ?></td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'trans_user'); ?></td>
                <td> 
                  <?php echo $form->dropDownList($model, 'trans_user',$this->getTranUsers(), array('id'=>'id_trans_user','style' => "height:34px;")); ?>   
                </td>
    </tr> 
</table>

<div class="row buttons">
    <?php echo CHtml::submitButton('保存', array('class' => 'btn btn-sm btn-primary')); ?> 
</div> 

<?php $this->endWidget(); ?>