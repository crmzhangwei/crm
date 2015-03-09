<?php
/* @var $this GroupInfoController */
/* @var $model GroupInfo */

$this->breadcrumbs=array(
	'Group Infos'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List GroupInfo', 'url'=>array('index')),
	array('label'=>'Create GroupInfo', 'url'=>array('create')),
	array('label'=>'Update GroupInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GroupInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GroupInfo', 'url'=>array('admin')),
);
?>

<h1>View GroupInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
