<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'安排联系机会'=>array('admin'),
	'批量安排联系时间',
);

$this->menu=array(
	 
);
?>

<h1>批量安排联系时间</h1>

<?php $this->renderPartial('_assign', array('model'=>$model,'custlist'=>$custlist)); ?>