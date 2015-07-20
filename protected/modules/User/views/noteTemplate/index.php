<?php
/* @var $this NoteTemplateController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Note Templates',
);

$this->menu=array(
	array('label'=>'Create NoteTemplate', 'url'=>array('create')),
	array('label'=>'Manage NoteTemplate', 'url'=>array('admin')),
);
?>

<h1>Note Templates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
