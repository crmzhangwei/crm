<?php
/* @var $this CustomerInfoController */
/* @var $model CustomerInfo */
/* @var $form CActiveForm */
?>

<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */
/* @var $form CActiveForm */
?>

<div class="form">


<div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
        <li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tabs-1" aria-labelledby="ui-id-29" aria-selected="true" aria-expanded="true">
            <a href="#tabs-1" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-29">基本信息</a>
        </li> 
        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-3" aria-labelledby="ui-id-31" aria-selected="false" aria-expanded="false">
            <a href="#tabs-2" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-31">小记录入</a>
        </li>
        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-4" aria-labelledby="ui-id-32" aria-selected="false" aria-expanded="false">
            <a href="#tabs-3" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-32">历史小记</a>
        </li>
        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-5" aria-labelledby="ui-id-33" aria-selected="false" aria-expanded="false">
            <a href="#tabs-4" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-33">共享小记</a>
        </li>  
    </ul> 
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-info-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
        'action'=>Yii::app()->controller->createUrl('update', array('id'=>$model->id)),
	'enableAjaxValidation'=>false,
)); ?>
    <div id="tabs-1" aria-labelledby="ui-id-29" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="false" style="display: block;">
	<?php $this->renderPartial('_baseinfo', array('model'=>$model,'form'=>$form)); ?> 
    </div>
   
    <?php $this->endWidget(); ?>

</div><!-- form -->
 



<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-info-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">带<span class="required">*</span>未必填项</p>

	<?php echo $form->errorSummary($model); ?>

	<table class="table table-bordered">
        <tr>
            <td width="10%"><?php echo $form->labelEx($model,'cust_name'); ?></td> 
            <td>
                <?php echo $form->textField($model,'cust_name',array('class'=>'col-md-6','maxlength'=>100)); ?>
				<?php echo $form->error($model,'cust_name'); ?>
            </td>
        </tr> 
    

	<tr>
		<td><?php echo $form->labelEx($model,'shop_name'); ?></td>
		<td>
			<?php echo $form->textField($model,'shop_name',array('class'=>'col-md-6','maxlength'=>100)); ?>
			<?php echo $form->error($model,'shop_name'); ?>
		</td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'corp_name'); ?></td>
		<td>
			<?php echo $form->textField($model,'corp_name',array('class'=>'col-md-6','maxlength'=>100)); ?>
			<?php echo $form->error($model,'corp_name'); ?>
		</td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'shop_url'); ?></td>
		<td>
		<?php echo $form->textField($model,'shop_url',array('class'=>'col-md-6','maxlength'=>100)); ?>
		<?php echo $form->error($model,'shop_url'); ?>
		</td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'shop_addr'); ?></td>
		<td>
		<?php echo $form->textField($model,'shop_addr',array('class'=>'col-md-6','maxlength'=>100)); ?>
		<?php echo $form->error($model,'shop_addr'); ?>
		</td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'phone'); ?></td>
		<td>
		<?php echo $form->textField($model,'phone',array('class'=>'col-md-6','maxlength'=>15)); ?>
		<?php echo $form->error($model,'phone'); ?>
		</td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'qq'); ?></td>
		<td>
		<?php echo $form->textField($model,'qq',array('class'=>'col-md-6','maxlength'=>15)); ?>
		<?php echo $form->error($model,'qq'); ?>
		</td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'mail'); ?></td>
		<td>
		<?php echo $form->textField($model,'mail',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'mail'); ?>
		</td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'datafrom'); ?></td>
		<td>
		<?php echo $form->textField($model,'datafrom',array('class'=>'col-md-6','maxlength'=>100)); ?>
		<?php echo $form->error($model,'datafrom'); ?>
		</td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'category'); ?></td>
		<td>
		<?php echo $form->dropDownList($model, 'category',$this->genCategoryArray(), array('style' => "height:34px;")); ?>
		<?php echo $form->error($model,'category'); ?>
		</td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'cust_type'); ?></td>
		<td>
		<?php echo $form->dropDownList($model, 'cust_type',$this->genCustTypeArray(), array('id'=>'cust_type','style' => "height:34px;")); ?>
		<?php echo $form->error($model,'cust_type'); ?>
		</td>
	</tr>

	<tr <?php if($model->cust_type != 6):?>style="display:none"<?php endif;?> id="visit_date_tr">
		<td><?php echo $form->labelEx($model,'visit_date'); ?></td>
		<td>
		<?php echo $form->textField($model,'visit_date',array('id'=>'visit_date','class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;')); ?>
		</td>
	</tr>

	<tr <?php if($model->cust_type != 8):?>style="display:none"<?php endif;?> id="abandon_reason_tr">
		<td><?php echo $form->labelEx($model,'abandon_reason'); ?></td>
		<td>
		<?php echo $form->dropDownList($model, 'abandon_reason',array('1'=>'无意向','2'=>'已成交','3'=>'黑名单'), array('id'=>'abandon_reason','style' => "height:34px;")); ?>
		<?php echo $form->error($model,'abandon_reason'); ?>
		</td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'iskey'); ?></td>
		<td>
		<?php echo $form->textField($model,'iskey'); ?>
		<?php echo $form->error($model,'iskey'); ?>
		</td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'eno'); ?></td>
		<td>
		<span><?=$model->eno?></span>
		</td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'assign_eno'); ?></td>
		<td><span><?=$model->assign_eno?></span></td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'assign_time'); ?></td>
		<td><span></span></td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'next_time'); ?></td>
		<td>
		<?php echo $form->textField($model,'next_time',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;')); ?>
		</td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'memo'); ?></td>
		<td><?php echo $form->textArea($model,'memo',array('class'=>'col-md-6','maxlength'=>255)); ?>
		<?php echo $form->error($model,'memo'); ?>
		</td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'create_time'); ?></td>
		<td></td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'creator'); ?></td>
		<td><?=$user->username?></td>
	</tr>

	<tr>
		<td colspan="2">
			<?php echo CHtml::submitButton('提 交',array('class'=>'btn btn-primary')); ?>
			<button class="btn btn-success" id="add_note">录入小记</button>
		</td>
	</tr>
</table>  
<?php $this->endWidget(); ?>

</div><!-- form -->


<script>
	
	$(function(){
		$("#cust_type").change(function(){
			var value = $(this).val();
			if(value == 6){
				$("#visit_date_tr").show();
			}else{
				$("#visit_date_tr").hide();
			}

			if(value == 8){
				$("#abandon_reason_tr").show();
			}else{
				$("#abandon_reason_tr").hide();
			}
		});

		$("#add_note").click(function(){
	        public.dialog('添加小记', '<?= Yii::app()->createUrl("chance/note/create") ?>',{},800);
			return false;
		});
	});
</script>