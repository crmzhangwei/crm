<?php
/* @var $this FinanceController */
/* @var $model Finance */
/* @var $form CActiveForm */
?>

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

	 <div class="row" >
		<?php echo $form->labelEx($model,'cust_id'); ?>
		<?php echo $form->textField($model,'cust_id'); ?> 
                <?php  echo CHtml::button("...",array('name'=>'btn_cust_pop','id'=>'id_btn_cust_pop'));?>
                <?php echo $form->error($model,'cust_id'); ?> 
             
	</div>
     
        <div class="row" >
		<?php echo $form->labelEx($model,'sale_user'); ?>
		<?php echo $form->textField($model,'sale_user'); ?>
		<?php echo $form->error($model,'sale_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trans_user'); ?>
		<?php echo $form->textField($model,'trans_user'); ?>
		<?php echo $form->error($model,'trans_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'acct_number'); ?>
		<?php echo $form->textField($model,'acct_number'); ?>
		<?php echo $form->error($model,'acct_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'acct_amount'); ?>
		<?php echo $form->textField($model,'acct_amount'); ?>
		<?php echo $form->error($model,'acct_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'acct_time'); ?>
		<!--<?php echo $form->textField($model,'acct_time'); ?>-->
                <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                        'language'=>'zh_cn',
			'name'=>'Finance[acct_time]',
			'value'=>Date('Y-m-d'),
			'options'=>array(
			            'showAnim'=>'fold',
			            'showOn'=>'both',
			            'buttonImage'=>'',
                                    'maxDate'=>'new Date()',
			            'buttonImageOnly'=>false,
			            'dateFormat'=>'yy-mm-dd',
			),
			'htmlOptions'=>array(
			            'style'=>'height:28px',
                                    'readonly'=>'readonly',
			            'maxlength'=>8,
			),
    ));
?>
		<?php echo $form->error($model,'acct_time'); ?>
	</div> 

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">  
  
        $("#id_btn_cust_pop").click(function(){  
            if (window.showModalDialog) {
                var result = window.showModalDialog('index.php?r=/Finance/finance/PopCustList',self,'dialogHeight: 550px; dialogWidth: 960px; dialogTop: 200px; dialogLeft: 300px;');
                $("#Finance_cust_id").val(result);
            }else{
               window.open('index.php?r=/Finance/finance/PopCustList','self','modal=yes,width=960,height=560,resizable=no,scrollbars=no'); 
            }
            
        });
        
</script>