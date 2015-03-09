<?php
/* @var $this DeptInfoController */
/* @var $model DeptInfo */

$this->breadcrumbs=array(
	'Dept Infos'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List DeptInfo', 'url'=>array('index')),
	array('label'=>'Create DeptInfo', 'url'=>array('create')),
	array('label'=>'Update DeptInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DeptInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DeptInfo', 'url'=>array('admin')),
);
?>

<h1>View DeptInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
