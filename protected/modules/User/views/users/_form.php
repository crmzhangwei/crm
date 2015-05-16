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
  
    
           
            <?php echo $form->hiddenField($model, 'id') ?>



<div class="row">
    <form class="form-horizontal" id="createUserForm" role="form" method="post" action="">
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right"><?php echo $model->getAttributeLabel('username'); ?>:</label>
            <div class="col-sm-3">
                <?php echo $form->textField($model, 'username', array( 'maxlength' => 20, 'id' => "form-field-1", 'placeholder' => "", 'class' => "form-control")); ?>
            </div>
            <label class="col-sm-2 control-label no-padding-right"><?php echo $model->getAttributeLabel('name'); ?>:</label>
            <div class="col-sm-3">
                <?php echo $form->textField($model, 'name', array( 'maxlength' =>12, 'id' => "form-field-1", 'placeholder' => "", 'class' => "form-control")); ?>
            </div>
        </div>
        

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right"><?php echo $model->getAttributeLabel('birth'); ?>：</label>
            <div class="col-sm-3">
                <?php echo $form->textField($model, 'birth', array( 'onClick' => "WdatePicker()", 'style' => 'height:30px;', 'id' => "form-field-1", 'placeholder' => "", 'class' => " Wdate form-control")); ?>
            </div>
            <label class="col-sm-2 control-label no-padding-right"><?php echo $model->getAttributeLabel('qq'); ?>：</label>
            <div class="col-sm-3">
                <?php echo $form->textField($model, 'qq', array( 'maxlength' =>14, 'id' => "form-field-1", 'placeholder' => "", 'class' => "form-control")); ?>
            </div>
        </div>
  
        <div class="form-group">
            <?php if($model->isNewRecord):?>
            <label class="col-sm-2 control-label no-padding-right">初始密码：</label>
            <div class="col-sm-3">
               <?php echo $form->textField($model, 'pass', array( 'maxlength' =>14, 'id' => "form-field-1", 'placeholder' => "", 'class' => "form-control")); ?>
            </div>
            <?php endif;?>
            <label class="col-sm-2 control-label no-padding-right"><?php echo $model->getAttributeLabel('tel'); ?>：</label>
            <div class="col-sm-3">
                <?php echo $form->textField($model, 'tel', array( 'maxlength' =>14, 'id' => "form-field-1", 'placeholder' => "", 'class' => "form-control")); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">部门：</label>
            <div class="col-sm-3">
                   <?php echo $form->dropDownList($model, 'dept_id', $this->getDeptArr(),array('onchange'=>'getgroup(this)')); ?>
            </div>
        </div>
         <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">组别：</label>
            <div class="col-sm-3">
                   <?php echo $form->dropDownList($model, 'group_id',  DeptGroup::model()->getByDeptId($model->dept_id),array('id'=>'groupinfo')); ?>
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
            <label class="col-sm-2 control-label no-padding-right"><?php echo $model->getAttributeLabel('ismaster'); ?>：</label>
            <div class="col-sm-4">
                <?php echo $form->radioButtonList($model, 'ismaster', array('否', '是'), array('separator' => '<br/> ', 'class' => 'col-sm-2')); ?>
            </div> 
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right"><?php echo $model->getAttributeLabel('sex'); ?>：</label>
            <div class="col-sm-4">
                <?php echo $form->radioButtonList($model, 'sex', array('女', '男'), array('separator' => '<br/>', 'class' => 'col-sm-2')); ?>
            </div>
            </div>
        <div class="form-actions text-right">
            <button type="submit" id="createUserBtn" class="btn btn-sm btn-primary"><i class="icon-save"></i> <?php echo$model->isNewRecord ? '创建' : '更新';?></button>
            <button type="button" data-dismiss="modal" class="btn btn-sm"><i class="icon-remove"></i> 取消</button>
        </div>
   <?php $this->endWidget();?>
</div>
<script>
    
    function getgroup(obj)
    {
        var deptid = $(obj).val(),groupStr;
        $.post("<?php echo $this->createUrl("/User/users/getGroup")?>",{'deptid':deptid},function(data)
	    {
	    	for(i in data)
	        {
	         	groupStr += '<option value ='+i+'>'+data[i]+'</option>';
	        }
	        $('#groupinfo').html(groupStr);
	    },'json')
    }
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