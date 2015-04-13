<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'users-form',
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
        'enableClientValidation'=>true,
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => true,
    ));
    ?>

    <p class="note">包括 <span class="required">*</span>为必填项.</p>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <?php echo $form->errorSummary($model); ?>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'eno', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model, 'eno', array('size' => 10, 'maxlength' => 10, 'id' => "form-field-1", 'placeholder' => "Username", 'class' => "input-large")); ?>
                    <?php echo $form->error($model, 'eno'); ?>
                </div>
            </div>



            <div class="form-group">
                <?php echo $form->labelEx($model, 'pass', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model, 'pass', array('size' => 50, 'maxlength' => 50, 'id' => "form-field-1", 'placeholder' => "", 'class' => "input-large")); ?>
                    <?php echo $form->error($model, 'pass'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'pass_repeat', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model, 'pass_repeat', array('size' => 50, 'maxlength' => 50, 'id' => "form-field-1", 'placeholder' => "", 'class' => "input-large")); ?>
                    <?php echo $form->error($model, 'pass_repeat'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'name', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model, 'name', array('size' => 20, 'maxlength' => 20, 'id' => "form-field-1", 'placeholder' => "", 'class' => "input-large")); ?>
                    <?php echo $form->error($model, 'name'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'username', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model, 'username', array('size' => 20, 'maxlength' => 20, 'id' => "form-field-1", 'placeholder' => "", 'class' => "input-large")); ?>
                    <?php echo $form->error($model, 'username'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'birth', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model, 'birth', array('onClick' => "WdatePicker()", 'style' => 'height:30px;', 'id' => "form-field-1", 'placeholder' => "", 'class' => " Wdate input-large")); ?>
                    <?php echo $form->error($model, 'birth'); ?>
                </div>
            </div>
            <div class="row buttons">
                <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '更新',array('class'=>'btn btn-sm btn-primary')); ?>
            </div>

        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'tel', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model, 'tel', array('size' => 20, 'maxlength' => 20, 'placeholder' => "", 'class' => "input-large")); ?>
                    <?php echo $form->error($model, 'tel'); ?>
                </div>
            </div>
          


            <div class="form-group">
                <?php echo $form->labelEx($model, 'qq', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model, 'qq', array('size' => 15, 'maxlength' => 15, 'placeholder' => "", 'class' => "input-large")); ?>
                    <?php echo $form->error($model, 'qq'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'dept_id', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                <div class="col-sm-9">
                    <?php echo $form->dropDownList($model, 'dept_id', $this->getDeptArr()); ?>
                    <?php echo $form->error($model, 'dept_id'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'group_id', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                <div class="col-sm-9">
                    <?php echo $form->dropDownList($model, 'group_id', $this->getGroupArr()); ?>
                    <?php echo $form->error($model, 'group_id'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'status', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                <div class="col-sm-9">
                    <?php echo $form->dropDownList($model, 'status', $this->getStatusArr()); ?>
                    <?php echo $form->error($model, 'status'); ?>
                </div>
            </div>


            <div class="form-group">
                <?php echo $form->labelEx($model, 'ismaster', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                 <div class="col-sm-9">
                <?php echo $form->radioButtonList($model, 'ismaster', array('否', '是'), array('separator' => ' ','class'=>'col-sm-2')); ?>
                <?php echo $form->error($model, 'ismaster'); ?>
                 </div> 
            </div>
       

             <div class="form-group">
                <?php echo $form->labelEx($model, 'sex', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                 <div class="col-sm-9">
                <?php echo $form->radioButtonList($model, 'sex', array('女', '男'), array('separator' => ' ','class'=>'col-sm-2')); ?>
                <?php echo $form->error($model, 'sex'); ?>
                 </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>

</div><!-- form -->