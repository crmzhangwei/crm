<?php
/* @var $this NoteTemplateController */
/* @var $model NoteTemplate */

$this->breadcrumbs=array(
	'Note Templates'=>array('index'),
	'Create',
);?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>