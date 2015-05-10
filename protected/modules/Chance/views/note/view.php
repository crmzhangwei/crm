<?php
/* @var $this NoteController */
/* @var $model NoteInfo */

$this->breadcrumbs=array(
	'Note Infos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List NoteInfo', 'url'=>array('index')),
	array('label'=>'Create NoteInfo', 'url'=>array('create')),
	array('label'=>'Update NoteInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete NoteInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NoteInfo', 'url'=>array('admin')),
);
?>

<h1>View NoteInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cust_id',
		'cust_info',
		'requirement',
		'service',
		'dissent',
		'next_followup',
		'memo',
		'isvalid',
		'iskey',
		'next_contact',
		'dial_id',
		'eno',
		'create_time',
	),
)); ?>
