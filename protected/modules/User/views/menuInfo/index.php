<?php

$this->pageTitle = '菜单资源管理';
$this->breadcrumbs = array(
    '权限管理',
    '菜单资源管理',
);
?>
<div class="row">
    <div class="col-xs-12">
        <div class="header">
            <button id="createNode" class="btn btn-info btn-sm">
                <i class="icon icon-plus"></i>
                增加节点
            </button>
            <button id="removeNode" class="btn btn-danger btn-sm">
                <i class="icon icon-remove"></i>
                删除节点
            </button>
        </div>
    </div>
    <div class="col-xs-12">
        <?php
        $this->widget('ext.tree.TreeWidget', array(
            'dataProvider' => $priv, // 传递数据
            'pid' => 'pid', // 设置层级关系id
            'tableClass' => 'table table-striped table-bordered table-hover table-projects', // 表格样式
            'tableHead' => array(// 设置表格列头信息
                '选择',
                '节点ID',
                '节点名称',
                '父节点',
                'URL',
                '操作',
            ),
        ));
        ?>

    </div>
</div>

<script type="text/javascript">
    $(function() {
        $("#createNode").click(function() {
            public.dialog('增加节点', '<?php echo $this->createUrl("/User/menuInfo/addNode"); ?>', {}, 700);
        });
        $(".addChildNode").click(function() {
            var pid = $(this).attr("priv_id");
            public.dialog('增加子节点', '<?php echo $this->createUrl("/User/menuInfo/addNode"); ?>', {pid: pid}, 700);
        });
        $(".editNode").click(function() {
            var pid = $(this).attr("priv_id");
            public.dialog('编辑节点', '<?php echo $this->createUrl("/User/menuInfo/editNode"); ?>', {id: pid}, 700);
        });

        $("#removeNode").click(function(){
            var pids = [];
            $(".chkPid:checked").each(function(i,d){
               pids.push( $(this).val() );
            });
            console.log( pids );
            if(pids.length ==0)
            {
                bootbox.alert('请选择需要删除的节点', function() {
                    });
            }else
            {
                public.Ajax({
                url: '<?php echo $this->createUrl("/User/menuInfo/removeAll"); ?>',
                data: {pids: pids},
                callback: function(res) {
                    bootbox.alert(res.msg, function() {
                        if (res.code == 1) {
                                window.location.reload();
                           }
                    });
                }
               });
            }
           
        });

        $(".removeNode").click(function() {
            var _this = $(this);
            var _parent = _this.parent().parent();
            var id = _this.attr('priv_id');
            bootbox.confirm("您确定删除吗?删除后将不可恢复!", function(result) {
                if (result) {
                  public.Ajax({
                        url: '<?php echo $this->createUrl("/User/menuInfo/remove"); ?>',
                        data: {id: id},
                        callback: function(res) {
                            bootbox.alert(res.msg, function() {
                                if (res.code == 1) {
                                    _parent.fadeOut(300, function() {
                                        _parent.remove();
                                    });
                                }
                            });
                        }
                    });
                }
            });
        });


    });
</script>