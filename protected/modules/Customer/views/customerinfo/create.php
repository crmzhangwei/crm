<?php
/* @var $this CustomerinfoController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'客户管理'=>array('index'),
	'添加客户',
);

$this->menu=array(
	array('label'=>'List CustomerInfo', 'url'=>array('index')),
	array('label'=>'Manage CustomerInfo', 'url'=>array('admin')),
);
?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>