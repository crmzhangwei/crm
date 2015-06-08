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
             <label class="col-sm-2 control-label no-padding-right">组别：</label>
            <div class="col-sm-3">
                   <?php echo $form->dropDownList($model, 'group_id',  DeptGroup::model()->getByDeptId($model->dept_id),array('id'=>'groupinfo')); ?>
            </div>
        </div>

     <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">上级：</label>
            <div class="col-sm-4">
                <input name="bossname" id="userinfo_bossname" class="form-control" type="text"  value="<?php echo $user_info['name']?$user_info['name']:'';?>" readonly>
                <?php echo $form->hiddenField($model, 'manager_id') ;?>
            </div>
            <div class="col-sm-1">
                <button type="button" id="selectBoss" class="btn btn-primary btn-sm"><i class="icon-plus"></i> 选择上级</button>
            </div>
        </div>
        <script>
           $('#selectBoss').click(function(){
               $("#sle").show();
           })
        </script>
         <div class="form-group" id='sle' style="display:none;">
             <label class="col-sm-2 control-label no-padding-right"></label>
            <div class="col-sm-10">
                 <?php if($model->isNewRecord):
			echo CHtml::dropDownList('dept','',$deptArr,array('onchange'=>'listgroup(this)'));
		?>
		<?php else:
			echo CHtml::dropDownList('dept',$user_info['dept_id'],$deptArr,array('onchange'=>'listgroup(this)'));
		endif;?>
		
		<?php if($model->isNewRecord):?>
		<select id="groupinfo2" name="group" onchange="listuser(this)">
			<option value ="0">--请选择组--</option>
		</select>
		<?php else: 
		    echo   CHtml::dropDownList('group', intval($user_info['group_id']), $user_info['group_arr'], array('id'=>"groupinfo2",'onchange'=>"listuser(this)"));
		     endif;?>

		<?php if($model->isNewRecord):?>
		<select id='userinfo' name="users" onchange="enoval(this)">	
			<option value ="0">---请选择人员---</option>
		</select>
		<?php else: 
		    echo   CHtml::dropDownList('users', $user_info['id'], $user_info['user_arr'], array('id'=>"userinfo",'onchange'=>"enoval(this)"));
		endif;?>
            </div> 
           
        </div>
  
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right"><?php echo $model->getAttributeLabel('ismaster'); ?>：</label>
            <div class="col-sm-4">
                <?php $model->isNewRecord ? $model->ismaster = 2: '';echo $form->radioButtonList($model, 'ismaster', array(2=>'否',1=> '是',), array('separator' => '<br/> ', 'class' => 'col-sm-2')); ?>
            </div> 
            <label class="col-sm-2 control-label no-padding-right"><?php echo $model->getAttributeLabel('sex'); ?>：</label>
            <div class="col-sm-4">
                <?php echo $form->radioButtonList($model, 'sex', array(1=>'男',2=>'女', ), array('separator' => '<br/>', 'class' => 'col-sm-2')); ?>
            </div>
        </div>
         <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right"><?php echo $model->getAttributeLabel('extend_no'); ?>：</label>
            <div class="col-sm-3">
                <?php echo $form->textField($model, 'extend_no', array('maxlength' => 10, 'id' => "form-field-1", 'placeholder' => "", 'class' => "form-control")); ?>
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
        
        var getGroupurl = '<?php echo Yii::app()->createUrl('/Customer/customerinfo/GetGroup');?>';
        var getUserurl = '<?php echo $this->createUrl('getUsers');?>';
     function listgroup(obj)
    {
      	var deptid = $(obj).val();
      	var groupStr = '<option value ="0">--请选择组--</option>';
      	if (deptid == 0) {
            $('#groupinfo2').html(groupStr);
            $('#userinfo').html('<option value ="0">--请选择人员--</option>');
            $('#userid').val('');
      	}
        else{
            $('#userinfo').html('<option value ="0">--请选择人员--</option>');
            $('#userid').val('');
        }
      	$.post(getGroupurl,{'deptid':deptid},function(data)
	    {
	    	
	    	for(i in data)
	        {
	         	groupStr += '<option value ='+i+'>'+data[i]+'</option>';
	        }
	        $('#groupinfo2').html(groupStr);
	    },'json')
    };

    function listuser(obj)
    {
      	var gid = $(obj).val();
        var deptid = $('#dept').val();
    	var optStr = '<option value ="0">---请选择人员---</option>';
    	if (gid == 0) {
            $('#userinfo').html(optStr);
            $('#userid').val('');
      	}
        else{
            $('#userid').val('');
        }
      	$.post(getUserurl,{'gid':gid,'deptid':deptid},function(data)
	    {
	    	
	    	for(i in data)
	        {
	         	optStr += '<option value ='+i+'>'+data[i]+'</option>';
	        }
	        $('#userinfo').html(optStr);
	    },'json')
	    
    }

    function enoval(obj){
    	var id = $(obj).val();
        var name =$('#userinfo :selected').html()
        console.log(name);
        if(id)
        {
            $('#Users_manager_id').val(id);
            $('#userinfo_bossname').val(name);
        }
    	
    }
 </script>