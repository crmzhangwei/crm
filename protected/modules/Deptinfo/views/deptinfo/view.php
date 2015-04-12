<?php
/* @var $this DeptinfoController */
/* @var $model Deptinfo */

$this->breadcrumbs=array(
	'Deptinfos'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Deptinfo', 'url'=>array('index')),
	array('label'=>'Create Deptinfo', 'url'=>array('create')),
	array('label'=>'Update Deptinfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Deptinfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Deptinfo', 'url'=>array('admin')),
);
?>

<h1>View Deptinfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
