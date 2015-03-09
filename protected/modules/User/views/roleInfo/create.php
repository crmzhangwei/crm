<?php
/* @var $this RoleInfoController */
/* @var $model RoleInfo */

$this->breadcrumbs=array(
	'Role Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RoleInfo', 'url'=>array('index')),
	array('label'=>'Manage RoleInfo', 'url'=>array('admin')),
);
?>

<h1>Create RoleInfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>