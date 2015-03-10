<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'Customer Infos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CustomerInfo', 'url'=>array('index')),
	array('label'=>'Create CustomerInfo', 'url'=>array('create')),
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

<h1>售后</h1>

<p>
你可以在输入框的开始处输入 (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>)，用以指定查询条件.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-info-grid',
	'dataProvider'=>$model->search(),
	'filter'=>null,
	'columns'=>array(
		'id',
		'cust_no',
		'cust_name',
		'shop_name',
		'corp_name',
		'shop_url',
		/*
		'shop_addr',
		'phone',
		'qq',
		'mail',
		'datafrom',
		'category',
		'cust_type',
		'eno',
		'iskey',
		'assign_eno',
		'assign_time',
		'next_time',
		'memo',
		'create_time',
		'creator',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
