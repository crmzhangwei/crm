<?php
/* @var $this MenuInfoController */
/* @var $model MenuInfo */

$this->breadcrumbs=array(
	'Menu Infos'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List MenuInfo', 'url'=>array('index')),
	array('label'=>'Create MenuInfo', 'url'=>array('create')),
	array('label'=>'Update MenuInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MenuInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MenuInfo', 'url'=>array('admin')),
);
?>

<h1>View MenuInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'url',
		'parent_id',
	),
)); ?>
