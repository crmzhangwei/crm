<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */

$this->breadcrumbs = array(
    '售后管理' => array('index'),
    '查询分配',
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
    $this->renderPartial('_search_admin', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->
<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl('Service/service/assignMulti'),
    'method' => 'post',
        ));
?>
<div class="form-group">
    <div class="btn-group">
<?php echo CHtml::submitButton('分配', array('class' => 'btn btn-sm btn-primary')); ?>
    </div>  
</div>

<?php
$dataProvider = $model->search();
$this->widget('GGridView', array(
    'id' => 'service-grid',
    'dataProvider' => $dataProvider,
    'filter' => null,
    'columns' => array(
        array('class' => 'CCheckBoxColumn',
            'name' => 'cust_id',
            'id' => 'select',
            'selectableRows' => 2,
            'headerTemplate' => '{item}',
            'htmlOptions' => array('width' => '20'),
        ),
        array('name' => 'cust_id', 'value' => '$data->cust_name'),
        array('name' => 'cust_type', 'value' => '$data->cust_type_name'),
        'qq',
        'webchat',
        'ww',
        array('name' => 'category', 'value' => '$data->category_name'),
        'service_limit',
        'eno',
        'assign_eno',
        array('name' => 'assign_time',
            'value' => 'date("Y-m-d",$data->assign_time)', //格式化日期  
        ),
        array('name' => 'next_time',
            'value' => 'date("Y-m-d",$data->next_time)', //格式化日期  
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
