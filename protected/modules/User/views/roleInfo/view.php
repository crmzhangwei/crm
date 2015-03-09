<?php
/* @var $this RoleInfoController */
/* @var $model RoleInfo */

$this->breadcrumbs=array(
	'Role Infos'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List RoleInfo', 'url'=>array('index')),
	array('label'=>'Create RoleInfo', 'url'=>array('create')),
	array('label'=>'Update RoleInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RoleInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RoleInfo', 'url'=>array('admin')),
);
?>

<h1>View RoleInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
