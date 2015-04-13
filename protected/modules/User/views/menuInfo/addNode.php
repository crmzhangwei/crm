<?php
/**
 *  addNode.php //TODO
*/
?>
<div class="row">
    <div class="col-xs-12">
        <form class="form-horizontal" role="form" action="" id="nodeForm"> 
            <div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label" for="id_pid">父节点</label>
                <div class="col-sm-5 col-xs-12">
                    <?php
                    $this->widget('ext.tree.TreeWidget',array(
                        'dataProvider'  => $priv,           
                        'pid'           => 'pid',                   
                        'treeType'      => false, 
                        'bindSelectValue' => $pid,
                        'selectClass'   => 'class="form-control"',
                         'defaultSelectValue' => array(
                                0 , '≡ 作为父级节点 ≡'
                         ),
                    ));
                    ?>
                </div>
            </div>  
            <div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label" for="node_name">节点名称</label>
                <div class="col-sm-5 col-xs-12">
                    <input name="node[name]" class="form-control" id="node_name" type="text" placeholder="节点名称" />
                </div>
            </div>  
  
            <div class="form-group" id="show_url" >
                <label class="col-sm-3 col-xs-12 control-label" for="node_url">URL</label>
                <div class="col-sm-8 col-xs-12">
                    <input name="node[url]" class="form-control" id="node_url" type="text" placeholder="例 /System/permission/index" />
                </div>
            </div> 
    
     
            <div class="form-group"> 
                <label class="col-sm-3 col-xs-12 control-label"></label>
                <div class="col-sm-8 col-xs-12">
                    <button type="submit" id="saveNode" class="btn btn-primary btn-sm" >
                        <i class="icon-save"></i>
                        保存
                    </button>
                    &nbsp;&nbsp;
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                        <i class="icon-remove"></i>
                        取消
                    </button>
                    <span id="loading"></span>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        
        $("#node_pertype").change(function(){
            if($(this).val() == 2){
                $("#show_url, #show_param").hide();
                $("#show_percode").show();
            } else if($(this).val() == ''){
                $("#show_url, #show_param").hide();
                $("#show_percode").hide();
            } else {
                $("#show_url, #show_param").show();
                $("#show_percode").hide();
            }
        });
        
       public.validate({
            form: $('#nodeForm'),
            rules: {
                'node[name]': {
                    required: true
                },
                'node[pertype]': {
                    required: true
                }
            },
            messages: {
                'node[name]': {
                    required: "请输入节点名称."
                },
                'node[pertype]': {
                    required: "请选择节点类型."
                }
            },
            submitHandler: function(form) {
                public.AjaxSaveForm({
                    obj: $("#saveNode"),
                    url: '<?php echo $this->createUrl("/User/menuInfo/addNode"); ?>',
                    data: $("#nodeForm").serialize(),
                    callback: function(res) {
                        console.log(res);
                        bootbox.alert(res.msg, function() {
                            if (res.code == 1) {
                                
                                window.location.reload();
                            }
                        });
                    }
                });
            }
        });

    });
</script>
