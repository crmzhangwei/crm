<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'users2-form',
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
        'enableClientValidation' => true,
        'action' => false,
        'enableAjaxValidation' => true,
    ));
    ?>

    <div class="row">

        <div class="col-xs-12"/>


        <div class="form-group">
             <?php echo $form->labelEx($model, 'pass', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
             <div class="col-sm-3 col-xs-12"> 
                <?php echo $form->textField($model, 'pass',array('size' => 10, 'maxlength' => 20, 'id' => "form-field-1", 'placeholder' => "", 'class' => "input-large")); ?> 
            </div>
        </div> 
   </div>
    <div class="row">
        <div class="form-group">
             <?php echo $form->labelEx($model, 'newpass', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
             <div class="col-sm-3 col-xs-12"> 
                <?php echo $form->textField($model, 'newpass',array('size' => 10, 'maxlength' => 20, 'id' => "form-field-1", 'placeholder' => "", 'class' => "input-large")); ?> 
            </div>
        </div> 
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"></label>
            <div class="col-sm-9">
                <?php echo CHtml::submitButton( '确认', array('class' => 'btn btn-sm btn-primary', 'id' => 'createUserBtn')); ?>
            </div>
        </div>
    </div>
</div>
</div>
<?php $this->endWidget(); ?>

<script>


    public.validate({
        form: $('#users2-form'),
        type: 1,
        rules: {
            'Users[pass]': {
                required: true
            },
            'Users[newpass]': {
                required: true
            },
        },
        messages: {
            'Users[pass]': {
                required: "请输入旧密码."
            },
            'Users[newpass]': {
                required: "请输入新密码"
            },
        },
        submitHandler: function (form) {


            public.AjaxSaveForm({
                obj: $("#createUserBtn"),
                url: '<?php echo $this->createUrl("site/updatepw") ?>',
                data: $("#users2-form").serialize(),
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