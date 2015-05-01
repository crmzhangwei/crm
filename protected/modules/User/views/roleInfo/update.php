<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'roleinfo-form',
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
        'enableClientValidation' => true,
        'action' => false,
        'enableAjaxValidation' => true,
    ));
    ?>

    <div class="row">

        <div class="col-xs-12"/>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'name', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
             <?php echo $form->hiddenField($model, 'id') ?>
            <div class="col-sm-3 col-xs-12">
                <?php echo $form->textField($model, 'name', array('size' => 10, 'maxlength' => 10, 'id' => "form-field-1", 'placeholder' => "", 'class' => "input-large")); ?>

            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"></label>
            <div class="col-sm-9">
                <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '更新', array('class' => 'btn btn-sm btn-primary', 'id' => 'createUserBtn')); ?>
            </div>
        </div>
    </div>
</div>
</div>
<?php $this->endWidget(); ?>

<script>


    public.validate({
        form: $('#roleinfo-form'),
        type: 1,
        rules: {
            'RoleInfo[name]': {
                required: true
            },
        },
        messages: {
            'RoleInfo[name]': {
                required: "请输入角色名."
            },
        },
        submitHandler: function (form) {


            public.AjaxSaveForm({
                obj: $("#createUserBtn"),
                url: '<?php echo $model->isNewRecord ?$this->createUrl("/User/roleinfo/create") :$this->createUrl("/User/roleinfo/update"); ?>',
                data: $("#roleinfo-form").serialize(),
                callback: function (result) {
                    bootbox.alert(result.msg, function () {
                        if (result.code == 1)
                            window.location.reload();
                    });
                }
            });
        }
    });
</script>