<?php
/* @var $this CustomerinfoController */
/* @var $model CustomerInfo */
$this->breadcrumbs = array(
    '客户管理' => array('admin'),
    '联系记录',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#customer-info-grid').yiiGridView('update', {
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

    <?php echo $form->dropDownList($model, 'searchtype', array('1'=>'联系人','2'=>'客户名称','3'=>'电话号码'), array('style' => "height:34px;")); ?>
    <?php echo $form->textField($model, 'keyword', array('size' => 25, 'maxlength' => 25)); ?>
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
    'id' => 'CustomerInfo-grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array('class' => 'CCheckBoxColumn',
            'name' => 'id',
            'id' => 'select',
            'selectableRows' => 0,
            'headerTemplate' => '{item}',
            'htmlOptions' => array(
                'width' => '20',
            ),
        ),
        'user_name',
        'cust_name',
        array('name' => 'phone', 'value' => 'substr_replace($data->phone,"****",3,4)'),
        array('name' => 'dial_time', 'value' => 'date("Y-m-d H:i:s",$data->dial_time)'),
        //'dial_long',
        array('name'=>'dial_long', 'value'=>'gmstrftime("%H:%M:%S",$data->dial_long)'),
        array(
            'class' => 'CButtonColumn',
            'deleteButtonOptions' => array(),
            'viewButtonOptions' => array('style' => 'background-color:red'),
            'header' => '操作',
            'template' => '{play}',
            'htmlOptions' => array(
                'width' => '50',
                'style' => 'text-align:center',
            ),
            'buttons' => array(
                'play' => array(
                    'label' => '播放和下载',
                    'url' => '',
                    'imageUrl' => '',
                    'options' => array('class' => 'btn btn-info btn-minier tooltip-info', 'onclick' => 'playAndDown(this)'),
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
   function playAndDown(obj)
    { 
        var trindex = $(obj).parents('tr').index();
        var dial_id = $('#select_' + trindex).val();
        var url;
        <?php $a = Yii::app()->createurl('Service/service/play3');
        echo 'url=' . "'$a'";
        ?> 
        public.dialog('播放和下载录音', url + '&id=' + dial_id);
    }
</script>  		
<script src="/static/js/secondlevel.js"></script>