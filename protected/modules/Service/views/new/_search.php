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
    
    <table class="table table-bordered table-hover table-projects" style="width:50%;">
            <tr>
                <td width="5%" nowrap="nowrap"><?php echo $form->labelEx($model,'dept'); ?></td>
                <td width="5%" nowrap="nowrap">
                    <?php echo $form->dropDownList($model,'dept',$this->getDeptArr(),array("onchange"=>"javascript:changeDept(this);")); ?>
                    <?php echo $form->dropDownList($model, "group", $this->getDeptGroupArr(1,false)) ?> 
                </td> 
                <td width="5%" nowrap="nowrap">类目</td>
                <td width="5%" nowrap="nowrap">
                    <?php echo $form->dropDownList($model,'category',$this->getCategoryArr()); ?>
                </td> 
                <td width="5%" nowrap="nowrap"><?php echo $form->dropDownList($model,'searchtype',array('1'=>'客户名称','2'=>'QQ','3'=>'旺旺','4'=>'微信')); ?></td>
                <td width="5%" nowrap="nowrap">
                    <?php echo $form->textField($model,'keyword',array('size'=>10,'maxlength'=>20)); ?>
                </td>
                <td><?php echo CHtml::submitButton('搜索',array('class' => 'btn btn-sm btn-primary')); ?></td>
            </tr>  
    </table>   

<?php $this->endWidget(); ?>

</div><!-- search-form -->