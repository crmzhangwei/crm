<?php
/* @var $this oldController */
/* @var $model CustomerInfo */
/* @var $form CActiveForm */
?>

<div class="form">


<div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
        <li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tabs-1" aria-labelledby="ui-id-29" aria-selected="true" aria-expanded="true">
            <a href="#tabs-1" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-29">基本信息</a>
        </li>  
        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-5" aria-labelledby="ui-id-33" aria-selected="false" aria-expanded="false">
            <a href="#tabs-5" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-33">共享小记</a>
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
	<?php $this->renderPartial('_baseinfo', array('model'=>$model,'form'=>$form,'note'=>$noteinfo,'after'=>$after,'contract'=>$contract)); ?> 
        <br/>
        <?php $this->renderPartial('_noteinfo_form', array('model'=>$noteinfo,'form'=>$form,'loginuser'=>$loginuser,'base'=>$model,'after'=>$after)); ?>
        <br/>
         <?php $this->renderPartial('_contractinfo_form', array('model'=>$model,'form'=>$form,'contract'=>$contract)); ?>
        <br/>
        <?php $this->endWidget(); ?>
        <?php $this->renderPartial('history_note', array('model'=>$historyNote)); ?> 
    </div> 
    <div id="tabs-5" aria-labelledby="ui-id-33" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="true" style="display: none;">
        <?php $this->renderPartial('shared_note', array('model'=>$sharedNote)); ?>
    </div>
   

</div><!-- form -->

