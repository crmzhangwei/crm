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
            <?php 
                if(!empty($contents)){ 
                    foreach($contents as $k=>$v){
                        echo '<input type="hidden" name="content_'.$v["id"].'" value="'.$v["content"].'" id="content_'.$v["id"].'"/>';
                    }
                }
            ?>
            短信模板:  <?php echo  $form->dropDownList($model, "message_template", $titles, array('onchange'=>'changeTemplate(this)')) ?><br/><br/>
            短信内容:   
                <?php echo $form->textArea($model,'message',array('rows'=>3,'cols'=>30,'id'=>'message_id')); ?>
	</div>

	<div class="row buttons" style="margin-top:40px">
		<?php echo CHtml::submitButton('发送',array('class' => 'btn btn-sm btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript"> 
 function changeTemplate(obj){
     var title_id = obj.value;
     $('#message_id').val($('#content_'+title_id).val());
 }
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
                    url: '<?php echo $this->createUrl("/Service/service/message",array('cust_id'=>$model->cust_id,'seq'=>$seq)); ?>',
                    data: $("#message-form").serialize(),
                    callback: function(result) {
                        bootbox.alert(result.msg, function(){
                            $('.modal-backdrop').hide();
                            $('.bootbox').hide();
                            $('#NoteInfo_message_id').val(result.id);
                        });
                    }
                });
            }
        });
</script>