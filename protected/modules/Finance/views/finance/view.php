<?php
/* @var $this FinanceController */
/* @var $model Finance */

$this->breadcrumbs=array(
	'Finances'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Finance', 'url'=>array('index')),
	array('label'=>'Create Finance', 'url'=>array('create')),
	array('label'=>'Update Finance', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Finance', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Finance', 'url'=>array('admin')),
);
?>

<h1>View Finance #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cust_id',
		'sale_user',
		'trans_user',
		'acct_number',
		'acct_amount',
		'acct_time',
		'creator',
		'create_time',
	),
)); ?>
