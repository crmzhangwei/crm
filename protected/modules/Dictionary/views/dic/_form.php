<?php
/* @var $this DicController */
/* @var $model Dic */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dic-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><span class="required">*</span>为必填项.</p>

	<?php echo $form->errorSummary($model); ?>
        <table class="table table-bordered">
            <tr>
                <td width="10%"><?php echo $form->labelEx($model,'code'); ?></td> 
                <td>
                    <?php echo $form->textField($model,'code',array('size'=>10,'maxlength'=>10)); ?>
                    <?php echo $form->error($model,'code'); ?> 
                </td>
            </tr>
            <tr>
                <td width="10%"><?php echo $form->labelEx($model,'name'); ?></td> 
                <td>
                    <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'name'); ?> 
                </td>
            </tr>
            <tr>
                <td width="10%"><?php echo $form->labelEx($model,'ctype'); ?></td> 
                <td>
                    <?php echo $form->textField($model,'ctype',array('size'=>20,'maxlength'=>20)); ?>
                    <?php echo $form->error($model,'ctype'); ?> 
                </td>
            </tr>
        </table>
	 

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->