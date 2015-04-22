<?php
/* @var $this FinanceController */
/* @var $model Finance */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>
    <table class="table table-bordered" style="width:50%;">
            <tr>
                <td width="5%" nowrap="nowrap">用户</td>
                <td width="5%" nowrap="nowrap">
                    <?php echo $form->dropDownList($model,'dept',$this->getDeptArr(),array("onchange"=>"javascript:changeDept(this);")); ?>
                    <?php echo $form->dropDownList($model, "group", $this->actionDeptGroupArr(1,false)) ?> 
                </td> 
                <td width="5%" nowrap="nowrap"><?php echo $form->labelEx($model,'cust_name'); ?></td>
                <td width="5%" nowrap="nowrap">
                     <?php echo $form->textField($model,'cust_name',array('size'=>10,'maxlength'=>20)); ?>
                </td>
                <td width="5%" nowrap="nowrap">时间段</td>
                <td width="5%" nowrap="nowrap">
                     <?php echo $form->textField($model,'createtime_start',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;',)); ?>
                      to 
                     <?php echo $form->textField($model,'createtime_end',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;')); ?>
                </td>
                <td width="5%" nowrap="nowrap">店铺名称</td>
                <td width="5%" nowrap="nowrap">
                   <?php echo $form->textField($model,'shopname'); ?>
                </td> 
                <td width="5%" nowrap="nowrap">客户电话</td>
                <td width="5%" nowrap="nowrap">
                   <?php echo $form->textField($model,'phone'); ?>
                </td> 
            </tr>
            <tr>
                <td colspan="10"> 
                    <div class="btn-group">
                            <a href="index.php?r=Finance/finance/create" id ='search_finance'  class="btn btn-sm btn-primary" > 
                                <i class="icon-plus"></i>新建财务数据
                            </a>  
                            <a href="javascript:void(0)" id ='create_finance'  class="btn btn-sm btn-primary" > 
                                <i class="icon-plus"></i>搜索
                            </a>
                    </div>
                </td>
            </tr>
    </table>

<?php $this->endWidget(); ?>

</div><!-- search-form -->