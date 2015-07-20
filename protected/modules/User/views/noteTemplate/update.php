<?php
/* @var $this NoteTemplateController */
/* @var $model NoteTemplate */

$this->breadcrumbs=array(
	'Note Templates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

