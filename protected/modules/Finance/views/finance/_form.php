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
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'finance-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><span class="required">*</span>字段为必填项.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <table class="table table-bordered">
            <tr>
                <td width="10%"> <?php echo $form->labelEx($model,'cust_id'); ?></td> 
                <td>
                    <?php echo $form->hiddenField($model,'cust_id'); ?>
                    <?php echo $form->textField($model,'cust_name'); ?>
                    <?php  echo CHtml::button("...",array('name'=>'btn_cust_pop','id'=>'id_btn_cust_pop'));?>
                    <?php echo $form->error($model,'cust_id'); ?> 
                </td>
            </tr> 
            <tr>
                <td width="10%"> <?php echo $form->labelEx($model,'sale_user'); ?></td> 
                <td> 
                    <?php echo $form->dropDownList($model, "dept", $this->getDeptArr(),array("onchange"=>"javascript:changeDept(this);")) ?>
                    <?php echo $form->dropDownList($model, "group", $this->actionDeptGroupArr($model->dept,false),array("onchange"=>"javascript:changeGroup()")) ?> 
                    <?php echo $form->dropDownList($model, "sale_user", $this->getUserArr($model->dept,$model->group,false)) ?>
                    <?php echo $form->error($model,'sale_user'); ?>
                </td>
            </tr> 
            <tr>
                <td width="10%"><?php echo $form->labelEx($model,'trans_user'); ?></td> 
                <td> 
                    <?php echo $form->dropDownList($model, "trans_user", $this->getAllTransUser()) ?>
                    <?php echo $form->error($model,'trans_user'); ?>
                </td>
            </tr>
            <tr>
                <td width="10%"><?php echo $form->labelEx($model,'acct_number'); ?></td> 
                <td>
                   <?php echo $form->textField($model,'acct_number'); ?>
                    <?php echo $form->error($model,'acct_number'); ?>
                </td>
            </tr>
            <tr>
                <td width="10%"><?php echo $form->labelEx($model,'acct_amount'); ?></td> 
                <td>
                   <?php echo $form->textField($model,'acct_amount'); ?>
                    <?php echo $form->error($model,'acct_amount'); ?>
                </td>
            </tr>
            <tr>
                <td width="10%"><?php echo $form->labelEx($model,'acct_time'); ?></td> 
                <td>
                   <?php echo $form->textField($model,'acct_time',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;')); ?>
		   <?php echo $form->error($model,'acct_time'); ?>
                </td>
            </tr>
        </table>  

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">  
  
        $("#id_btn_cust_pop").click(function(){  
            if (window.showModalDialog) {
                var result = window.showModalDialog('index.php?r=/Finance/finance/PopCustList',self,'dialogHeight: 550px; dialogWidth: 960px; dialogTop: 200px; dialogLeft: 300px;');
                var values = result.split(",");
                $("#Finance_cust_id").val(values[0]);
                $("#Finance_cust_name").val(values[1]);
            }else{
               window.open('index.php?r=/Finance/finance/PopCustList','self','modal=yes,width=960,height=560,resizable=no,scrollbars=no'); 
            }
            
        });
        
</script>