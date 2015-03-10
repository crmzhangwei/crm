<?php
/* @var $this CusttypeController */
/* @var $model CustType */

$this->breadcrumbs=array(
	'客户分类'=>array('admin'),
	'增加',
);

$this->menu=array(
	array('label'=>'List CustType', 'url'=>array('index')),
	array('label'=>'Manage CustType', 'url'=>array('admin')),
);
?>

<h1>创建客户分类</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>