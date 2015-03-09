<?php
/* @var $this DeptGroupController */
/* @var $model DeptGroup */

$this->breadcrumbs=array(
	'Dept Groups'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DeptGroup', 'url'=>array('index')),
	array('label'=>'Create DeptGroup', 'url'=>array('create')),
	array('label'=>'Update DeptGroup', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DeptGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DeptGroup', 'url'=>array('admin')),
);
?>

<h1>View DeptGroup #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'dept_id',
		'group_id',
	),
)); ?>
