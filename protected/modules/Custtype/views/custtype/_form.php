<?php
/* @var $this CusttypeController */
/* @var $model CustType */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cust-type-form',
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
                <td width="10%"><?php echo $form->labelEx($model,'lib_type'); ?></td> 
                <td>
                    <?php echo  $form->dropDownList($model, "lib_type", $this->getLibArr()) ?>
                    <?php echo $form->error($model,'lib_type'); ?> 
                </td>
            </tr> 
            <tr>
                <td width="10%"><?php echo $form->labelEx($model,'type_no'); ?></td> 
                <td>
                    <?php echo $form->textField($model,'type_no'); ?>
                    <?php echo $form->error($model,'type_no'); ?> 
                </td>
            </tr>
            <tr>
                <td width="10%"><?php echo $form->labelEx($model,'type_name'); ?></td> 
                <td>
                    <?php echo $form->textField($model,'type_name'); ?>
                    <?php echo $form->error($model,'type_name'); ?> 
                </td>
            </tr>
         </table> 
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存',array('class' => 'btn btn-sm btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->