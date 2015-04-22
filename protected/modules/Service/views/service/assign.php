<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'售后-客户查询分配'=>array('admin'),
	'分配',
);

$this->menu=array(
	 
);
?>

<h1>售后客户分配</h1>

<?php $this->renderPartial('_assign', array('model'=>$model,'custlist'=>$custlist)); ?>