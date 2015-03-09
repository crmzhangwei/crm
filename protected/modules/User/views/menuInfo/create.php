<?php
/* @var $this MenuInfoController */
/* @var $model MenuInfo */

$this->breadcrumbs=array(
	'Menu Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MenuInfo', 'url'=>array('index')),
	array('label'=>'Manage MenuInfo', 'url'=>array('admin')),
);
?>

<h1>Create MenuInfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>