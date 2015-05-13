<?php
/* @var $this FinanceController */
/* @var $model Finance */
/* @var $form CActiveForm */
?>
<script type="text/javascript">
     function changeDept(obj){
            var vUrl = "index.php?r=/Finance/finance/DeptGroupArr&isajax=true&deptid="+obj.value;
            $.getJSON(vUrl,function(jsonObj){  
                        if(jsonObj){
                            $("#Finance_group").empty();
                            $.each(jsonObj, function(i, item) {  
                                $("<option></option>")
                                .val(item.group_id)
                                .text(item.group_name)
                                .appendTo($("#Finance_group"));
                        });
                        changeGroup();
                        } 
                    }   
                );
        }
     function changeGroup(){
            var dept = $("#Finance_dept").val();
            var group = $("#Finance_group").val();
            var vUrl = "index.php?r=/Finance/finance/UserArr&deptid="+dept+"&groupid="+group;
            $.getJSON(vUrl,function(jsonObj){  
                        if(jsonObj){
                            $("#Finance_sale_user").empty();
                            $.each(jsonObj, function(i, item) {   
                            $("<option></option>")
                            .val(item.id)
                            .text(item.name)
                            .appendTo($("#Finance_sale_user"));
                        });
                        } 
                    }   
                );
        }
    </script>
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>
    <table class="table table-bordered" style="width:50%;">
            <tr>
                <td width="5%" nowrap="nowrap">销售用户</td>
                <td width="5%" nowrap="nowrap">
                    <?php echo $form->dropDownList($model,'dept',$this->getDeptArr(),array("onchange"=>"javascript:changeDept(this);")); ?>
                    <?php echo $form->dropDownList($model, "group", $this->actionDeptGroupArr($model->dept,false),array("onchange"=>"javascript:changeGroup();")) ?> 
                    <?php echo $form->dropDownList($model, "sale_user", $this->getUserArr($model->dept,$model->group,false)) ?>
                </td>  
                <td width="5%" nowrap="nowrap">时间段</td>
                <td width="5%" nowrap="nowrap">
                     <?php echo $form->textField($model,'acct_time_start',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;',)); ?>
                      to 
                     <?php echo $form->textField($model,'acct_time_end',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;')); ?>
                </td> 
                <td width="5%" nowrap="nowrap"><?php echo $form->dropDownList($model, "searchtype", array('1'=>'客户名称','2'=>'店铺名称','3'=>'客户电话')) ?></td>
                <td width="10%" nowrap="nowrap">
                     <?php echo $form->textField($model,'keyword',array('size'=>30,'maxlength'=>20)); ?>
                </td>
            </tr>
            <tr>
                <td colspan="10"> 
                    <div class="btn-group">
                        <a href="<?php echo Yii::app()->createUrl('Finance/finance/create')?>" id ='create_finance'  class="btn btn-sm btn-primary" > 
                                <i class="icon-plus"></i>新建财务数据
                            </a>  
                            <a href="javascript:void(0)" id ='search_finance'  class="btn btn-sm btn-primary" > 
                                <i class="icon-plus"></i>搜索
                            </a>
                    </div>
                </td>
            </tr>
    </table>

<?php $this->endWidget(); ?>

</div><!-- search-form -->