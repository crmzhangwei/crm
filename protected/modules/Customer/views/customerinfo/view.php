<?php
/* @var $this CustomerinfoController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'Customer Infos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CustomerInfo', 'url'=>array('index')),
	array('label'=>'Create CustomerInfo', 'url'=>array('create')),
	array('label'=>'Update CustomerInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CustomerInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CustomerInfo', 'url'=>array('admin')),
);
?>

<h1>View CustomerInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cust_name',
		'shop_name',
		'corp_name',
		'shop_url',
		'shop_addr',
		'phone',
		'qq',
		'mail',
		'datafrom',
		'category',
		'cust_type',
		'eno',
		'assign_eno',
		'assign_time',
		'next_time',
		'memo',
		'create_time',
		'creator',
	),
)); ?>
