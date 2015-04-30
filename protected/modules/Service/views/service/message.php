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
            短信内容:  
                <textarea rows="3" cols="30" name="message" value=""></textarea>
	</div>

	<div class="row buttons" style="margin-top:40px">
		<?php echo CHtml::submitButton('发送'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
 $('#message-form form').submit(function(){
        alert(1); 
	return false;
 });  
</script>