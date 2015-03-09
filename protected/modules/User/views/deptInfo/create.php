<?php
/* @var $this DeptInfoController */
/* @var $model DeptInfo */

$this->breadcrumbs=array(
	'Dept Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DeptInfo', 'url'=>array('index')),
	array('label'=>'Manage DeptInfo', 'url'=>array('admin')),
);
?>

<h1>Create DeptInfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>