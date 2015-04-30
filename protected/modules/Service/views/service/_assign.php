 <script type="text/javascript">
     function changeDept(obj){
            var vUrl = "index.php?r=/Service/service/DeptGroupArr&isajax=true&deptid="+obj.value;
            $.getJSON(vUrl,function(jsonObj){  
                        if(jsonObj){
                            $("#CustomerInfo_group").empty();
                            $.each(jsonObj, function(i, item) { 
                            $("<option></option>")
                            .val(item.group_id)
                            .text(item.group_name)
                            .appendTo($("#CustomerInfo_group"));
                        });
                        changeGroup();
                        } 
                    }   
                );
        }
     function changeGroup(){
            var dept = $("#CustomerInfo_dept").val();
            var group = $("#CustomerInfo_group").val();
            var vUrl = "index.php?r=/Service/service/UserArr&deptid="+dept+"&groupid="+group;
            $.getJSON(vUrl,function(jsonObj){  
                        if(jsonObj){
                            $("#CustomerInfo_eno").empty();
                            $.each(jsonObj, function(i, item) {  
                            $("<option></option>")
                            .val(item.id)
                            .text(item.name)
                            .appendTo($("#CustomerInfo_eno"));
                        });
                        } 
                    }   
                );
        }
    </script>
<?php
Yii::app()->clientScript->registerScript('buttonA', " 
       
        $('#btn_cancel').click(
            function(){
                $('#finance-form').attr('action','index.php?r=Service/service/admin');
                $('#finance-form').submit();
            }
        );
        
        ");
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'finance-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'action'=>Yii::app()->createUrl('/Service/service/assignMulti')
)); ?>

	<p class="note"><span class="required">*</span>字段为必填项.</p>

	<?php echo $form->errorSummary($model); ?>
        <input type="hidden" name="issave" value="true"/>
        <table class="table table-bordered">
            <tr>
                <td width="10%">待分配客户</td>
                <td>
                    <?php  
                        foreach($custlist as $cust){ 
                            echo '<input type="hidden" name="cust_id[]" value="'.$cust->id.'"/>';
                            echo $cust->cust_name.",";
                        } 
                    ?> 
                </td>
            </tr>
            <tr>
                <td width="10%"> <?php echo $form->labelEx($model,'eno'); ?></td> 
                <td> 
                    <?php echo $form->dropDownList($model, "dept", $this->getDeptArr(),array("onchange"=>"javascript:changeDept(this);")) ?>
                    <?php echo $form->dropDownList($model, "group", $this->getDeptGroupArr(1,false),array("onchange"=>"javascript:changeGroup()")) ?> 
                    <?php echo $form->dropDownList($model, "eno", $this->getUserArr(1,1,false)) ?>
                    <?php echo $form->error($model,'eno'); ?>
                </td>
                
            </tr> 
        </table>
            <div class="row buttons">
		<?php echo CHtml::submitButton('分配'); ?>
                <?php echo CHtml::button('取消',array('id'=>'btn_cancel')); ?>
            </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

