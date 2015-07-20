<?php
/* @var $this NoteTemplateController */
/* @var $model NoteTemplate */

$this->breadcrumbs=array(
	'Note Templates'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List NoteTemplate', 'url'=>array('index')),
	array('label'=>'Create NoteTemplate', 'url'=>array('create')),
	array('label'=>'Update NoteTemplate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete NoteTemplate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NoteTemplate', 'url'=>array('admin')),
);
?>

<h1>View NoteTemplate #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tname',
		'content',
	),
)); ?>
