<?php
/* @var $this DeptGroupController */
/* @var $model DeptGroup */

$this->breadcrumbs=array(
	'Dept Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DeptGroup', 'url'=>array('index')),
	array('label'=>'Manage DeptGroup', 'url'=>array('admin')),
);
?>

<h1>Create DeptGroup</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>