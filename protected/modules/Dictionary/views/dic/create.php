<?php
/* @var $this DicController */
/* @var $model Dic */

$this->breadcrumbs=array(
	'字典数据'=>array('admin'),
	'添加',
);

$this->menu=array(
	array('label'=>'List Dic', 'url'=>array('index')),
	array('label'=>'Manage Dic', 'url'=>array('admin')),
);
?>

<h1>添加字典数据</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>