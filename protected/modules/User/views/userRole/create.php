<?php
/* @var $this UserRoleController */
/* @var $model UserRole */

$this->breadcrumbs=array(
	'User Roles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserRole', 'url'=>array('index')),
	array('label'=>'Manage UserRole', 'url'=>array('admin')),
);
?>

<h1>Create UserRole</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>