<?php

$this->pageTitle = '人员角色管理页面';
$this->breadcrumbs = array(
    '人员角色管理' => array('/User/userRole/admin'),
    '人员角色管理页面',
);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="tabbable">
            <ul class="nav nav-tabs padding-12 tab-color-blue" id="myTab4">
                
                <li class="active">
                    <a href="<?php echo Yii::app()->createUrl('/User/userRole/admin'); ?>">人员角色分配</a>
                </li>
               
            </ul>

            <div class="tab-content">
                <div id="dropdown14" class="tab-pane in active">    
                    <div class="row">
                        <div class="row">
                            <div class="col-xs-7" style="padding-left:50px;">
                                   <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'customer-info-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'action' => Yii::app()->controller->createUrl('admin'),
            'enableAjaxValidation' => false,
        ));
        ?>
                                <?php echo $form->textField($model,'username',array('maxlength'=>100,'size'=>30))?>
                                <?php echo CHtml::submitButton('搜索',array('class' => 'btn btn-sm btn-primary')); ?> 
                                <?php $this->endWidget(); ?> 
                            </div> 
                            <div class="col-xs-5" style="padding-right:50px;">
                                <!-- .右侧保存按钮 -->
                                <div style="float: right;">
                                    <button type="button" id="saveBtn" class="btn btn-primary btn-sm">  
                                        <i class="icon-save"></i>
                                        保存设置
                                    </button> 
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <!-- .header -->
                            <div class="col-sm-12 no-padding-top">
                                <div class="col-xs-7" style="padding-left:50px;">
                                    <!-- .表头说明部分 -->
                                    <h5 class="row header lighter">
                                        <span class="col-xs-6 smaller"> 选择人员：<strong id="selRoleName"></strong></span>
                                        <input type="hidden" name="roleid" id="roleId" value="">
                                    </h5>
                                </div>
                                <div class="col-xs-5" style="padding:0 50px 0 50px;">
                                    <!-- .树说明 -->
                                    <div class="col-sm-12 no-padding-top header lighter">
                                        选择相应角色：
                                    </div>  <!-- .header -->
                                </div>  <!-- .header -->
                            </div>

                            <div class="col-xs-7" style="padding-left:50px; border-right: 1px dashed #ccc;">
                                <!--表格部分-->
                                <div class="col-sm-12 no-padding-top">
                                    <div class="row">
                                        <table id="roles_list" class="table table-bordered table-projects table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 45px;">ID</th>
                                                    <th class="text-center">人员名称</th>
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                 
                                                 $dataProvider=new CActiveDataProvider('Users',array('criteria'=>$criteria)); 
                                                 $dataProvider->pagination->pageVar = 'page';
                                                 $dept_list = $dataProvider->getData();
                                                 if($dept_list):
                                                    foreach($dept_list as $k=>$v):
                                                ?>
                                                    <tr roleid="<?php echo $v['id'];?>">
                                                        <td class="text-right"><?php echo $v['id'];?></td>
                                                        <td class="text-left"><?php echo $v['name'];?></td>
                                                      
                                                    </tr>
                                                <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- end table-list -->
                                <!-- .pagination分页 -->
                                <div class="row table-page">
                                    <div class="col-sm-6" style="padding-left: 20px;"> 
                                        共<span class="orange"><?= $dataProvider->totalItemCount ?></span>条记录
                                    </div>
                                    <div class="col-sm-6 no-padding-right"> 
                                        <?php
                                        $this->widget('GLinkPager', array(
                                                'pages' => $dataProvider->pagination,
                                            )
                                        );
                                        ?>
                                    </div>
                                </div> <!-- .pagination -->
                            </div>

                             <div class="col-xs-5" style="padding-left:50px;">
                                <!-- .树部分 -->
                                <div class="col-sm-12 no-padding-top">
                                    <div class="row">
                                        <div class="row">
                                            <div class="widget-main padding-8">
                                                <div id="permission_tree"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jstree/themes/default/style.min.css" type="text/css">
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jstree/jstree.min.js"></script>
<script type="text/javascript">
    jQuery(function($) {
        $('#permission_tree').jstree({'plugins': ["checkbox"], 
            "checkbox" : {
                'tie_selection': true,
               },
            'core': {
            'data': <?php echo $permission; ?>
        }});
        var tree = $('#permission_tree');
         $("#roles_list tbody tr").css({"cursor":"pointer"}).bind("click", function(){
            var roleid = $(this).attr( 'roleid' );
            $("#roleId").val( roleid );
            $("#roles_list tbody tr").each(function(i, e){
                $(this).css({"background":"none" }).removeClass("red");
            });
            $(this).css({"background-color":"#E5E5E5"}).addClass("red");
            $("#selRoleName").html( $(this).find("td:eq(1)").text() );
            tree.jstree(true).close_all();
            tree.jstree(true).uncheck_all();
            $.ajax({
                url: '<?php echo $this->createUrl('/User/userRole/selectRolePermission');?>',
                type: 'post',
                data: {roleid: roleid},
                dataType: 'json',
            
                success: function(result){
                    
                    $(result).each(function(i, data){
                        $('#permission_tree').jstree(true).select_node( data.id );
                    });
                },
        
            });
            
        });
        
        $("#saveBtn").click(function(){
            var _this = $(this);
            var nodes = $("#permission_tree").jstree("get_checked");
            var roleid = $("#roleId").val();
            if(roleid == '') {
                bootbox.alert('请选择人员');
                return;
            }                
           public.Ajax({
                url: '<?php echo $this->createUrl('/User/userRole/assignRolePermission');?>',
                data: {roleid: roleid, pids: nodes},
                callback: function(result){
                    bootbox.alert( result.msg );
                }
            });
            
        });
        
    });
</script>
