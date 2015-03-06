<?php
/* @var $this FinanceController */
/* @var $model Finance */

$this->breadcrumbs=array(
	'Finances'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Finance', 'url'=>array('index')),
	array('label'=>'Manage Finance', 'url'=>array('admin')),
);
?>

<h1>Create Finance</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>