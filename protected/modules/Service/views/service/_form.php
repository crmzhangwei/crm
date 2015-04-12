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
            <a href="#tabs-1" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-29">基本信息</a>
        </li> 
        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-6" aria-labelledby="ui-id-34" aria-selected="false" aria-expanded="false">
            <a href="#tabs-6" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-34">合同信息</a>
        </li>
        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-3" aria-labelledby="ui-id-31" aria-selected="false" aria-expanded="false">
            <a href="#tabs-3" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-31">小记录入</a>
        </li>
        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-4" aria-labelledby="ui-id-32" aria-selected="false" aria-expanded="false">
            <a href="#tabs-4" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-32">历史小记</a>
        </li>
        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-5" aria-labelledby="ui-id-33" aria-selected="false" aria-expanded="false">
            <a href="#tabs-5" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-33">共享小记</a>
        </li> 
        
    </ul> 
    <div id="tabs-1" aria-labelledby="ui-id-29" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="false" style="display: block;">
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?> 
        <table class="table table-bordered"> 
            <tr>
                <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model,'cust_name'); ?></td>
                <td width="20%" nowrap="nowrap">
                    <?php echo $model->cust_name; ?>
                    <?php echo $form->error($model,'cust_name'); ?>
                </td>
                <td width="10%" nowrap="nowrap"><?php echo $form->labelEx($model,'shop_name'); ?></td>
                <td><?php echo $model->shop_name; ?>
		<?php echo $form->error($model,'shop_name'); ?></td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'corp_name'); ?></td>
                <td>
                    <?php echo $model->corp_name ?>
                    <?php echo $form->error($model,'corp_name'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'shop_url'); ?></td>
                <td><?php echo $model->shop_url; ?>
		<?php echo $form->error($model,'shop_url'); ?></td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'shop_addr'); ?></td>
                <td>
                    <?php echo $model->shop_addr; ?>
                    <?php echo $form->error($model,'shop_addr'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'phone'); ?></td>
                <td><?php echo Utils::hidePhone($model->phone); ?>
                    <?php echo CHtml::ajaxButton("拔打电话", "index.php?r=Service/service/dial", array('success'=>'dial_ret(data)')) ?>
                <?php echo CHtml::ajaxButton("发送短信", "index.php?r=Service/service/message", array('success'=>'message_ret(data)')) ?>
		<?php echo $form->error($model,'phone'); ?>
                </td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'qq'); ?></td>
                <td>
                   <?php  echo Utils::hideQq($model->qq);  ?>
		   <?php echo $form->error($model,'qq'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'mail'); ?></td>
                <td><?php  echo Utils::hideEmail($model->mail);  ?>
                    <?php echo CHtml::ajaxButton("发邮件", "index.php?r=Service/service/mail", array('success'=>'mail_ret(data)')) ?>
		<?php echo $form->error($model,'mail'); ?></td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'datafrom'); ?></td>
                <td>
                   <?php echo $model->datafrom; ?>
		<?php echo $form->error($model,'datafrom'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'category'); ?></td>
                <td>
                    <?php echo  $form->dropDownList($model, "category", $this->getCategoryArr()) ?>
		<?php echo $form->error($model,'category'); ?></td>
            </tr>
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'cust_type'); ?></td>
                <td> 
                    <?php echo  $form->dropDownList($model, "cust_type", $this->getCustTypeArr()) ?>
                    <?php echo $form->error($model,'cust_type'); ?>
                </td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'eno'); ?></td>
                <td><?php echo $model->eno; ?>
		<?php echo $form->error($model,'eno'); ?></td>
            </tr>
            <tr> 
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'assign_eno'); ?></td>
                <td><?php echo $model->assign_eno; ?></td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'assign_time'); ?></td>
                <td>
                   <?php echo $model->assign_time; ?>  
                </td>
            </tr>
            
            <tr>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'next_time'); ?></td>
                <td>
                    <?php echo $form->textField($model,'next_time',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;')); ?>
                    <?php echo $form->error($model,'next_time'); ?></td>
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'memo'); ?></td>
                <td>
                <?php echo $form->textArea($model,'memo',array('rows'=>3,'cols'=>30)); ?>
		<?php echo $form->error($model,'memo'); ?>
                </td> 
            </tr>
            <tr> 
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'creator'); ?></td>
                <td>
                   <?php echo $model->user['eno']; ?>  
                </td> 
                <td nowrap="nowrap"><?php echo $form->labelEx($model,'create_time'); ?></td>
                <td><?php echo $model->create_time; ?>
		<?php echo $form->error($model,'create_time'); ?></td>
            </tr>
        </table>
    </div>
    <div id="tabs-6" aria-labelledby="ui-id-34" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="true" style="display: none;">
        <?php $this->renderPartial('_contractinfo_form', array('model'=>$model,'form'=>$form)); ?> 
    </div> 
    <div id="tabs-3" aria-labelledby="ui-id-31" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="true" style="display: none;">
       <?php $this->renderPartial('_noteinfo_form', array('model'=>$noteinfo,'form'=>$form,'loginuser'=>$loginuser)); ?>
    </div>
    <div id="tabs-4" aria-labelledby="ui-id-32" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="true" style="display: none;">
        <?php $this->renderPartial('_history_note_list', array('model'=>$sharedNote)); ?>
    </div>
    <div id="tabs-5" aria-labelledby="ui-id-33" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="true" style="display: none;">
        <?php $this->renderPartial('_shared_note_list', array('model'=>$sharedNote)); ?>
    </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

