<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'用户管理'=>array(''),
	'创建用户',
);

$this->menu=array(
	array('label'=>'用户例表', 'url'=>array('index')),
	array('label'=>'管理用户', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>