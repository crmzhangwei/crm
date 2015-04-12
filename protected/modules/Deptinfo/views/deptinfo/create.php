<?php
/* @var $this DeptinfoController */
/* @var $model Deptinfo */

$this->breadcrumbs=array(
	'Deptinfos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Deptinfo', 'url'=>array('index')),
	array('label'=>'Manage Deptinfo', 'url'=>array('admin')),
);
?>

<h1>Create Deptinfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>