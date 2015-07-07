<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */

$this->breadcrumbs = array(
    '售后管理' => array('list'),
    '今日联系',
);

$this->menu = array(
);

Yii::app()->clientScript->registerScript('search', " 
$('.search-form form').submit(function(){
	$('#service-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?> 
<div class="search-form" style="display:">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->
<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl('Service/service/assignNextTime'),
    'method' => 'post',
        ));
?>
<div class="form-group">
    <div class="btn-group">
    <?php echo CHtml::submitButton('批量安排联系时间', array('class' => 'btn btn-sm btn-primary')); ?>
    </div>  
</div>
<?php
$dataProvider = $model->searchTodayList();
$this->widget('GGridView', array(
    'id' => 'service-grid',
    'dataProvider' => $dataProvider,
    'filter' => null,
    'columns' => array(
        array('class' => 'CCheckBoxColumn',
            'name' => 'id',
            'id' => 'select',
            'selectableRows' => 2,
            'headerTemplate' => '{item}',
            'htmlOptions' => array(
                'width' => '20',
            ),
        ),
        'id',
        array('name' => 'cust_id', 'value' => '$data->cust_name'),
        array('name' => 'cust_type', 'value' => array($this,'get_after_type_text')),
        'qq',
        'webchat',
        'ww',
        array('name' => 'category', 'value' => '$data->category_name'),
        'service_limit',
        array('name' => 'eno', 'value' => array($this,'get_eno_text')),
        array('name' => 'assign_eno', 'value' => array($this,'get_assign_eno_text')),
        array('name'=>'assign_time',  
                    'value'=>'date("Y-m-d H:i:s",$data->assign_time)',//格式化日期  
                ),  
        array('name'=>'next_time',  
                    'value'=>'date("Y-m-d H:i:s",$data->next_time)',//格式化日期  
                ),
        array('name'=>'last_time',  
                    'value'=>'date("Y-m-d H:i:s",$data->last_time)',//格式化日期  
                ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{upda}',
            'buttons' => array(
                'upda' => array(
                    'label' => '查看客户详情',
                    'url' => 'Yii::app()->controller->createUrl("edit",array("id"=>$data->primaryKey))',
                    'imageUrl' => '',
                    'options' => array('class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"),
                ),
            ),
        ),
    ),
));
?>
<?php $this->endWidget(); ?>
<div class="table-page"> 
    <div class="col-sm-6">
        共<span class="orange"><?= $dataProvider->totalItemCount ?></span>条记录 
    </div>
    <div class="col-sm-6 no-padding-right">
<?php
$this->widget('GLinkPager', array('pages' => $dataProvider->getPagination(),));
?>
    </div>
</div>
