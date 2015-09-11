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
            <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-5" aria-labelledby="ui-id-33" aria-selected="false" aria-expanded="false">
                <a href="#tabs-5" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-33">共享小记</a>
            </li> 
        </ul> 
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'customer-info-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'action' => Yii::app()->controller->createUrl('update', array('id' => $model->id,'module'=>$module)),
            'enableAjaxValidation' => false,
        ));
        ?>
        <div id="tabs-1" aria-labelledby="ui-id-29" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="false" style="display: block;">
            <?php $this->renderPartial('_baseinfo', array('model' => $model, 'trans_model' => $trans_model, 'user' => $user, 'contract' => $contract, 'form' => $form)); ?>
            <br/>
            <?php $this->renderPartial('_noteinfo_form', array('model' => $noteinfo, 'custmodel' => $model, 'form' => $form)); ?>
            <br/>
            <?php $this->endWidget(); ?> 
            <?php $this->renderPartial('history_note', array('model' => $historyNote, 'custmodel' => $model)); ?>
        </div> 

        <div id="tabs-5" aria-labelledby="ui-id-33" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="true" style="display: none;">
            <?php $this->renderPartial('shared_note', array('model' => $sharedNote, 'custmodel' => $model)); ?>
        </div>  
    </div><!-- form -->



    <script>

        $(function() {
            var value = $('#cust_type').val();
            if (value == 17) {
                $("#tb_contract").show();
                $("#tr_abandon").hide();
            } else if (value == 18) {
                $("#tr_abandon").show();
                $("#tb_contract").hide();
            } else {
                $("#tr_abandon").hide();
                $("#tb_contract").hide();
            }

        });
    </script>