<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'售后管理'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'客户详情',
);

$this->menu=array(
	 
);
Yii::app()->clientScript->registerScript('tab', " 
$('#tabs').tabs();
"); 
?>

<h1>客户详情 <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'sharedNote'=>$sharedNote,'historyNote'=>$historyNote,'noteinfo'=>$noteinfo)); ?>

