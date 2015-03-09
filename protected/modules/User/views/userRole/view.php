<?php
/* @var $this UserRoleController */
/* @var $model UserRole */

$this->breadcrumbs=array(
	'User Roles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserRole', 'url'=>array('index')),
	array('label'=>'Create UserRole', 'url'=>array('create')),
	array('label'=>'Update UserRole', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserRole', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserRole', 'url'=>array('admin')),
);
?>

<h1>View UserRole #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'role_id',
	),
)); ?>
