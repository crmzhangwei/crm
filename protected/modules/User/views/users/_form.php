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
        'action'=>false,
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
           
            <?php echo $form->hiddenField($model, 'id') ?>

     


            <div class="form-group">
                <?php echo $form->labelEx($model, 'name', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model, 'name', array('size' => 20, 'maxlength' => 20, 'id' => "form-field-1", 'placeholder' => "", 'class' => "input-large")); ?>
       
                </div>
            </div>

           <?php if($model->isNewRecord):?>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'pass', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model, 'pass', array('size' => 50, 'maxlength' => 50, 'id' => "form-field-1", 'placeholder' => "", 'class' => "input-large")); ?>
            
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'pass_repeat', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model, 'pass_repeat', array('size' => 50, 'maxlength' => 50, 'id' => "form-field-1", 'placeholder' => "", 'class' => "input-large")); ?>
                   
                </div>
            </div>
           <?php endif;?>
          

     

            <div class="form-group">
                <?php echo $form->labelEx($model, 'birth', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model, 'birth', array('onClick' => "WdatePicker()", 'style' => 'height:30px;', 'id' => "form-field-1", 'placeholder' => "", 'class' => " Wdate input-large")); ?>
                </div>
            </div>
            <div class="row buttons">
                <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '更新',array('class'=>'btn btn-sm btn-primary','id'=>'createUserBtn')); ?>
            </div>

        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'tel', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model, 'tel', array('size' => 20, 'maxlength' => 20, 'placeholder' => "", 'class' => "input-large")); ?>
                   
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
       <div class="form-group">
                <?php echo $form->labelEx($model, 'username', array('class' => 'col-sm-2 control-label no-padding-right')); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model, 'username', array('size' => 20, 'maxlength' => 20, 'id' => "form-field-1", 'placeholder' => "", 'class' => "input-large")); ?>
                  
                </div>
            </div>

<div class="row">
    <form class="form-horizontal" id="createUserForm" role="form" method="post" action="">
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right"><?php echo $model->getAttributeLabel('username'); ?>:</label>
            <div class="col-sm-3">
                <?php echo $form->textField($model, 'username', array( 'maxlength' => 20, 'id' => "form-field-1", 'placeholder' => "", 'class' => "form-control")); ?>
            </div>
            <label class="col-sm-2 control-label no-padding-right">英文名/昵称：</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="userinfo[nick]">
            </div>
        </div><div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">手机号码：</label>
            <div class="col-sm-3">
                <input name="userinfo[mobile]" class="form-control" type="text">
            </div>
            <label class="col-sm-2 control-label no-padding-right">QQ：</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="userinfo[qq]">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Email：</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="userinfo[email]">
            </div>
            <label class="col-sm-2 control-label no-padding-right">工号：</label>
            <div class="col-sm-3">
                <input name="userinfo[gonghao]" class="form-control" type="text">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">初始密码：</label>
            <div class="col-sm-3">
                <input name="" id="userinfo_pwd" class="form-control" type="text" value="to8to123">
                <input name="userinfo[pwd]" id="userinfo_pwd_" type="hidden" value="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">部门：</label>
            <div class="col-sm-4">
                <input name="groupname" id="userinfo_groupname" class="form-control" type="text" readonly>
                <input type="hidden" id="userinfo_groupid" name="userinfo[groupid]">
            </div>
            <div class="col-sm-1">
                <button type="button" id="selectGroups" class="btn btn-primary btn-sm"><i class="icon-plus"></i> 选择部门</button>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">上级：</label>
            <div class="col-sm-4">
                <input name="bossname" id="userinfo_bossname" class="form-control" type="text" readonly>
                <input type="hidden" id="userinfo_bossid" name="userinfo[bossid]">
            </div>
            <div class="col-sm-1">
                <button type="button" id="selectBoss" class="btn btn-primary btn-sm"><i class="icon-plus"></i> 选择上级</button>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">职务：</label>
            <div class="col-sm-4">
                <?php
                //echo CHtml::dropDownList('userinfo[position]', '', $jobs, array('class' => 'form-control', 'empty' => '请选择职务'));
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">固定角色：</label>
            <div class="col-sm-4">
                <?php
               // echo CHtml::dropDownList('userinfo[roleid]', '', CHtml::listData($role_list, '_id', 'name'), array('class' => 'form-control', 'empty' => '请选择角色'));
                ?>
            </div>
        </div>
        <div class="form-actions text-right">
            <button type="submit" id="createUserBtn" class="btn btn-sm btn-primary"><i class="icon-save"></i> 保存</button>
            <button type="button" data-dismiss="modal" class="btn btn-sm"><i class="icon-remove"></i> 取消</button>
        </div>
    </form>
</div>
<script>
    
   
    public.validate({
            form: $('#users-form'),
            type: 2,
            rules: {
                'Users[username]': {
                    required: true
                },
                
                'Users[name]': {
                    required: true
                },
                'Users[pass]': {
                    required: true
                },
                'Users[tel]': {
                    required: true
                },
                'Users[dept_id]': {
                    required: true
                },
         
            },
            messages: {
                'Users[username]': {
                    required: "请输入用户名."
                },
                'Users[name]': {
                    required: "请输入昵称."
                },
                'Users[pass]': {
                    required: "请输入密码."
                },
                'Users[tel]': {
                    required: "请输入电话."
                },
                'Users[dept_id]': {
                    required: "请选择所属部门."
                },
                'Users[roleid]': {
                    required: "请选择固定角色."
                }
            },
            submitHandler: function (form) {
              
              
                public.AjaxSaveForm({
                    obj: $("#createUserBtn"),
                    url: '<?php  echo  $model->isNewRecord ? $this->createUrl("/User/users/create"):$this->createUrl("/User/users/update"); ?>',
                    data: $("#users-form").serialize(),
                    callback: function(result) {
                        bootbox.alert(result.msg, function(){
                           if(result.code == 1)  window.location.reload();
                        });
                    }
                });
            }
        });
 </script>