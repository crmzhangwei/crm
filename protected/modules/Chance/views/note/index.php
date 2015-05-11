<?php
/* @var $this NoteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Note Infos',
);

$this->menu=array(
	array('label'=>'Create NoteInfo', 'url'=>array('create')),
	array('label'=>'Manage NoteInfo', 'url'=>array('admin')),
);
?>

<h1>Note Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
