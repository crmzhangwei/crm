<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */
 
 
?> 

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'message-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?> 
	<div class="row">
            <?php echo $form->hiddenField($model,'cust_id'); ?>
            短信内容:   
                <?php echo $form->textArea($model,'message',array('rows'=>3,'cols'=>30)); ?>
	</div>

	<div class="row buttons" style="margin-top:40px">
		<?php echo CHtml::submitButton('发送'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript"> 
 
 public.validate({
            form: $('#message-form'),
            type: 2,
            rules: {
                'AftermarketCustInfo[message]': {
                    required: true
                }, 
            },
            messages: {
                'AftermarketCustInfo[message]': {
                    required: "请输入短信内容."
                }, 
            },
            submitHandler: function (form) {  
                public.AjaxSaveForm({
                    obj: $("#createUserBtn"),
                    url: '<?php echo $this->createUrl("/Service/service/message",array('cust_id'=>$model->cust_id)); ?>',
                    data: $("#message-form").serialize(),
                    callback: function(result) {
                        bootbox.alert(result.msg, function(){
                            $('.modal-backdrop').hide(); 
                        });
                    }
                });
            }
        });
</script>