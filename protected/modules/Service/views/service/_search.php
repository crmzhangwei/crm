<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */
/* @var $form CActiveForm */
?>
<script type="text/javascript">
     function changeDept(obj){
            var vUrl = "index.php?r=/Service/service/DeptGroupArr&isajax=true&deptid="+obj.value;
            $.getJSON(vUrl,function(jsonObj){  
                        if(jsonObj){
                            $("#AftermarketCustInfo_group").empty();
                            $.each(jsonObj, function(i, item) { 
                            $("<option></option>")
                            .val(item.group_id)
                            .text(item.group_name)
                            .appendTo($("#AftermarketCustInfo_group"));
                        }); 
                        } 
                    }   
                );
        }
 </script>
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
    
    <table class="table table-bordered" style="width:50%;">
            <tr>
                <td width="5%" nowrap="nowrap"><?php echo $form->labelEx($model,'dept'); ?></td>
                <td width="5%" nowrap="nowrap">
                    <?php echo $form->dropDownList($model,'dept',$this->getDeptArr(),array("onchange"=>"javascript:changeDept(this);")); ?>
                    <?php echo $form->dropDownList($model, "group", $this->getDeptGroupArr(1,false)) ?> 
                </td> 
                <td width="5%" nowrap="nowrap"><?php echo $form->labelEx($model,'cust_name'); ?></td>
                <td width="5%" nowrap="nowrap">
                     <?php echo $form->textField($model,'cust_name',array('size'=>10,'maxlength'=>20)); ?>
                </td>
                <td width="5%" nowrap="nowrap">客户分类</td>
                <td width="5%" nowrap="nowrap">
                    <?php echo $form->dropDownList($model,'cust_type',$this->getCustTypeArr()); ?>
                </td>
                <td width="5%" nowrap="nowrap"><?php echo $form->labelEx($model,'qq'); ?></td>
                <td width="5%" nowrap="nowrap">
                   <?php echo $form->textField($model,'qq',array('size'=>10,'maxlength'=>20)); ?>
                </td> 
            </tr> 
            <tr>
                <td width="5%" nowrap="nowrap"><?php echo $form->labelEx($model,'webchat'); ?></td>
                <td width="5%" nowrap="nowrap">
                    <?php echo $form->textField($model,'webchat',array('size'=>10,'maxlength'=>20)); ?>
                </td> 
                <td width="5%" nowrap="nowrap"><?php echo $form->labelEx($model,'ww'); ?></td>
                <td width="5%" nowrap="nowrap">
                     <?php echo $form->textField($model,'ww',array('size'=>10,'maxlength'=>20)); ?>
                </td>
                <td width="5%" nowrap="nowrap">类目</td>
                <td width="5%" nowrap="nowrap">
                    <?php echo $form->dropDownList($model,'category',$this->getCategoryArr()); ?>
                </td>
                <td width="10%" nowrap="nowrap" colspan="2" align="center"> 
                   <?php echo CHtml::submitButton('搜索'); ?>
                </td> 
            </tr> 
    </table>  

<?php $this->endWidget(); ?>

</div><!-- search-form -->