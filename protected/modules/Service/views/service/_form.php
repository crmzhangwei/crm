<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-info-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
        <li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tabs-1" aria-labelledby="ui-id-29" aria-selected="true" aria-expanded="true">
            <a href="#tabs-1" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-29">客户详情</a>
        </li>  
        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-2" aria-labelledby="ui-id-30" aria-selected="false" aria-expanded="false">
            <a href="#tabs-2" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-30">小记录入</a>
        </li> 
        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-3" aria-labelledby="ui-id-31" aria-selected="false" aria-expanded="false">
            <a href="#tabs-3" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-31">历史小记</a>
        </li>
        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-4" aria-labelledby="ui-id-32" aria-selected="false" aria-expanded="false">
            <a href="#tabs-4" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-32">共享小记</a>
        </li>
    </ul> 
    <div id="tabs-1" aria-labelledby="ui-id-29" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="false" style="display: block;">
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?> 
        <table class="table table-bordered"> 
            <tr>
                <td><?php echo $form->labelEx($model,'cust[cust_name]'); ?></td>
                <td>
                    <?php echo $form->textField($model,'cust[cust_name]',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'cust[cust_name]'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'cust[shop_name]'); ?></td>
                <td><?php echo $form->textField($model,'cust[shop_name]',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cust[shop_name]'); ?></td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'cust[corp_name]'); ?></td>
                <td>
                    <?php echo $form->textField($model,'cust[corp_name]',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'cust[corp_name]'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'cust[shop_url]'); ?></td>
                <td><?php echo $form->textField($model,'cust[shop_url]',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cust[shop_url]'); ?></td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'cust[shop_addr]'); ?></td>
                <td>
                    <?php echo $form->textField($model,'cust[shop_addr]',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'cust[shop_addr]'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'cust[phone]'); ?></td>
                <td><?php echo $form->textField($model,'cust[phone]',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'cust[phone]'); ?></td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'cust[qq]'); ?></td>
                <td>
                   <?php echo $form->textField($model,'cust[qq]',array('size'=>20,'maxlength'=>20)); ?>
		   <?php echo $form->error($model,'cust[qq]'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'cust[mail]'); ?></td>
                <td><?php echo $form->textField($model,'cust[mail]',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cust[mail]'); ?></td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'cust[datafrom]'); ?></td>
                <td>
                   <?php echo $form->textField($model,'cust[datafrom]',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cust[datafrom]'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'category'); ?></td>
                <td><?php echo $form->textField($model,'category'); ?>
		<?php echo $form->error($model,'category'); ?></td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'cust_type'); ?></td>
                <td>
                   <?php echo $form->textField($model,'cust_type'); ?>
		<?php echo $form->error($model,'cust_type'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'eno'); ?></td>
                <td><?php echo $form->textField($model,'eno',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'eno'); ?></td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'cust[iskey]'); ?></td>
                <td>
                   <?php echo $form->textField($model,'cust[iskey]'); ?>
		<?php echo $form->error($model,'cust[iskey]'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'assign_eno'); ?></td>
                <td><?php echo $form->textField($model,'assign_eno',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'assign_eno'); ?></td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'assign_time'); ?></td>
                <td>
                   <?php echo $form->textField($model,'assign_time'); ?>
		<?php echo $form->error($model,'assign_time'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'next_time'); ?></td>
                <td><?php echo $form->textField($model,'next_time'); ?>
		<?php echo $form->error($model,'next_time'); ?></td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'memo'); ?></td>
                <td>
                   <?php echo $form->textField($model,'memo',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'memo'); ?>
                </td>
                <td><?php echo $form->labelEx($model,'create_time'); ?></td>
                <td><?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?></td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'creator'); ?></td>
                <td>
                   <?php echo $form->textField($model,'creator'); ?>
		<?php echo $form->error($model,'creator'); ?>
                </td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
    <div id="tabs-2" aria-labelledby="ui-id-30" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="true" style="display: none;">
        小记录入
       <?php $this->renderPartial('_noteinfo_form', array('model'=>$noteinfo,'form'=>$form)); ?>
    </div> 
    <div id="tabs-3" aria-labelledby="ui-id-31" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="true" style="display: none;">
       <?php $this->renderPartial('_history_note_list', array('model'=>$sharedNote)); ?>
    </div>
    <div id="tabs-4" aria-labelledby="ui-id-32" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="true" style="display: none;">
        <?php $this->renderPartial('_shared_note_list', array('model'=>$sharedNote)); ?>
    </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

