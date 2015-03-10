<?php
/* @var $this DicController */
/* @var $model Dic */

$this->breadcrumbs=array(
	'Dics'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Dic', 'url'=>array('index')),
	array('label'=>'Create Dic', 'url'=>array('create')),
	array('label'=>'Update Dic', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Dic', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Dic', 'url'=>array('admin')),
);
?>

<h1>View Dic #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'name',
		'ctype',
	),
)); ?>
