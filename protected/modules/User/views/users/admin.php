<?php
/* @var $this UsersController */
/* @var $model Users */
$this->pageTitle = '查看用户页面';
$this->breadcrumbs = array(
    '权限管理' => array('admin'),
    '查看用户',
);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>
<div class="form-group">
    <div class="btn-group">
        <a href="javascript:void(0)" id ='create_user'  class="btn btn-sm btn-primary" > 
            <i class="icon-plus"></i>新建用户
        </a>
    </div>        
<?php echo $form->label($model, 'eno'); ?>
<?php echo $form->textField($model, 'eno', array('size' => 10, 'maxlength' => 10)); ?>
<?php echo $form->dropDownList($model, 'searchtype', Users::getsearchArr(), array('style' => "height:34px;")); ?>
    <?php echo $form->textField($model, 'keyword', array('size' => 30, 'maxlength' => 30)); ?>

    <button class="btn btn-sm btn-primary" type="submit">
        <i class="icon-search"></i>
        搜 索
    </button>
</div>

<?php $this->endWidget(); ?>

<?php
$dataProvider = $model->search();
$dataProvider->pagination->pageVar = 'page';
$this->widget('GGridView', array(
    'id' => 'users-grid',
    'dataProvider' =>$dataProvider,
    'columns' => array(
        array('class' => 'CCheckBoxColumn',
            'name' => 'id',
            'id' => 'select',
            'headerTemplate' => '<input id="select_all" class="select-on-check" type="checkbox" name="" >全选',
            'htmlOptions' => array(
                'width' => '60',
            ),
        ),
        'id',
        'eno',
        'name',
        'username',
        'tel',
        'qq',
        array(
            'name' => 'dept_id',
            'value' => array($this, 'get_dept_text'),
        ),
        array(
            'name' => 'group_id',
            'value' => array($this, 'get_group_text'),
        ),
        //'dept_id'
		array(
            'name' => 'manager_id',
            'value' => array($this, 'get_manager_id'),
        ),
        array(
            'name' => 'ismaster',
            'value' => array($this, 'get_ismaster_text'),
        ),
        //'group_id',
        //'ismaster',
        'extend_no',
        array('name'=>'ext_status','value'=>array($this,'get_ext_status')),
        array(
            'name' => 'status',
            'value' => array($this, 'get_status_text'),
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => '操作',
            'template' => '{upda} {listen} ',
            'htmlOptions' => array(
                'width' => '150',
                'style' => 'text-align:center',
            ),
            'buttons' => array(
                'upda' => array(
                    'label' => '修改',
                    'url' => '',
                    'imageUrl' => '',
                    'options' => array('class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom", 'onclick' => "updatarow(this)"),
                ),
                'listen' => array(
                    'label' => '监听',
                    'url' => '',
                    'imageUrl' => '',
                    'options' => array('class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom", 'onclick' => "listenOn(this)"),
                ),
            ),
        ),
    ),
     'htmlOptions'=>array('style'=>'"{$data->getHtmlOptions()}"'),  
));
?>

<div class="table-page"> 
    <div class="col-sm-6">
        共<span class="orange"><?= $dataProvider->totalItemCount ?></span>条记录
        <a href="javascript:void(0);" js_type="publish"  col='0' class="btn  btn-minier btn-sm btn-success publish"><i class=" icon-ok icon-large"></i>设置精英</a> 
		<a href="javascript:void(0);" js_type="cancel_publish" col='0' class="btn  btn-minier btn-sm btn-warning publish"> <i class="icon-lock icon-large"></i>取消精英</a>
        <!--<a href="javascript:void(0);" js_type="publish"  col='1' class="btn  btn-minier btn-sm btn-success publish"><i class=" icon-ok icon-large"></i>设置在职</a> -->
		<a href="javascript:void(0);" js_type="cancel_publish" col='1' class="btn  btn-minier btn-sm btn-warning publish"> <i class="icon-lock icon-large"></i>设置离职</a> 
    </div>
    <div class="col-sm-6 no-padding-right">
<?php
$this->widget('GLinkPager', array('pages' => $dataProvider->pagination,));
?>
    </div>
</div>  		

<script>
    $(function ()
    {
        $('#create_user').click(function ()
        {
            public.dialog('增加用户', '<?= Yii::app()->createUrl('User/users/create') ?>', {}, 900);
        })
    })

    function updatarow(obj)
    {

        var trindex = $(obj).parents('tr').index();
        var id = $('#select_' + trindex).val();
        var url;
        <?php  $a = Yii::app()->createurl('User/users/update/');
        echo 'url=' . "'$a'" ?>
                
        public.dialog('修改用户信息', url + '&id=' + id);
    }


    function getIds(dom) {
        var ids = '';
        dom.each(function (index, element) {
            ids += ',' + $(this).val();
        });
        return  ids.substring(1);
    }
      function listenOn(obj)
    {
        var trindex = $(obj).parents('tr').index();
        var userid = $('#select_' + trindex).val();
        var url;
<?php
$a = Yii::app()->createurl('User/extNumber/listenByUser');
echo 'url=' . "'$a';";
?>
        url = url + "&userid=" + userid;
        $.getJSON(url, function (jsonObj) {
            if (jsonObj) {
                if (jsonObj.result) {
                    bootbox.alert('监听成功，请拿机话机!');
                } else {
                    bootbox.alert(jsonObj.message);
                }
            }
        });
    }
</script>

<?php
$publishUrl = Yii::app()->createUrl("/User/users/publish/", array('ajax' => '1'));
$jss = <<<EOF
       $(function () {
        
        $(".publish").click(function () {
            var ids = getIds($('input[name="select[]"]:checked'));
            if (!ids) {
                bootbox.alert('请选择需要操作人！');
                return;
            }
          
            $.post(' $publishUrl ', {'ids': ids, 'type': $(this).attr('js_type'),'col':$(this).attr('col')}, function (data) {
                $("body").find(".to8to-box-overlay-2").remove();
                bootbox.alert(data.msg, function () {
                    if (data.code == "1") {
                        location.reload();
                    }
                });
            }, 'json');
        });
    });
EOF;
Yii::app()->clientScript->registerScript('topicjss', $jss);
?>
