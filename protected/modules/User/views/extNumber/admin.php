<?php
$this->breadcrumbs = array(
    '权限管理' => array('admin'),
    '分机号管理',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ExtNumber-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!-- search-form -->

<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>

<div class="form-group">
    <?php echo $form->dropDownList($model, 'searchtype', ExtNumber::getsearchArr(), array('style' => "height:34px;")); ?>
<?php echo $form->textField($model, 'keyword', array('size' => 30, 'maxlength' => 30)); ?>   
    <button class="btn btn-sm btn-primary" type="submit">
        <i class="icon-search"></i>
        搜 索
    </button>
    <div class="btn-group" style="padding-top:5px;color:red;">
        分机状态: 1正在通话  0未通话
    </div> 
</div>

<?php $this->endWidget(); ?>

<?php
$dataProvider = $model->search();
$dataProvider->pagination->pageVar = 'page';
$this->widget('GGridView', array(
    'id' => 'ExtNumber-grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array('class' => 'CCheckBoxColumn',
            'name' => 'extension',
            'id' => 'select',
            'selectableRows' => 2,
            'headerTemplate' => '{item}',
            'htmlOptions' => array(
                'width' => '20',
            ),
        ),
        //'id',
        'extension',
		array('name' => 'uname', 'value'=>array($this, 'get_uname')),
        'status',
        array(
            'class' => 'CButtonColumn',
            'deleteButtonOptions' => array('style' => 'display:none'),
            'viewButtonOptions' => array('style' => 'background-color:red'),
            'header' => '操作',
            'template' => '{upda} {delete}',
            'htmlOptions' => array(
                'width' => '80',
                'style' => 'text-align:center',
            ),
            'buttons' => array(
                'upda' => array(
                    'label' => '监听',
                    'url' => '',
                    'imageUrl' => '',
                    'options' => array('class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom", 'onclick' => "listenOn(this)"),
                ),
            )
        ),
    ),
));
?>

<div class="table-page"> 
    <div class="col-sm-6">
        共<span class="orange"><?= $dataProvider->totalItemCount ?></span>条记录
    </div>
    <div class="col-sm-6 no-padding-right">
        <?php
        $this->widget('GLinkPager', array('pages' => $dataProvider->pagination,));
        ?>
    </div>
</div>

<script>
    function listenOn(obj)
    {
        var trindex = $(obj).parents('tr').index();
        var extnum = $('#select_' + trindex).val();
        var url;
<?php
$a = Yii::app()->createurl('User/extNumber/listen');
echo 'url=' . "'$a';";
?>
        url = url + "&ext=" + extnum;
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
