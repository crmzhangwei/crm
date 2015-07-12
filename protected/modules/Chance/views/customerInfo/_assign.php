   
<?php
Yii::app()->clientScript->registerScript('buttonA', " 
       
        $('#btn_cancel').click(
            function(){
                $('#finance-form').attr('action','index.php?r=Chance/customerInfo/admin');
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
        'action'=>Yii::app()->createUrl('/Chance/customerInfo/assignNextTime')
)); ?>

	<p class="note"><span class="required">*</span>字段为必填项.</p>

	<?php echo $form->errorSummary($model); ?> 
        <table class="table table-bordered">
            <tr>
                <td width="10%">待安排客户</td>
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
                <td width="10%"> 下次联系时间</td> 
                <td> 
                    <input type="text" name="next_time" value="" class="Wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" style="height:30px;" /> 
                </td>
                
            </tr> 
        </table>
            <div class="row buttons">
		<?php echo CHtml::submitButton('安排',array('class' => 'btn btn-sm btn-primary')); ?>
                <?php echo CHtml::button('取消',array('id'=>'btn_cancel','class' => 'btn btn-sm btn-primary')); ?>
            </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

