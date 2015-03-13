<?php
/* @var $this FinanceController */
/* @var $model Finance */

$this->breadcrumbs=array(
	'Finances'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Finance', 'url'=>array('index')),
	array('label'=>'Manage Finance', 'url'=>array('admin')),
);
Yii::app()->clientScript->registerScript('search', "
 
");
?>
   
<h1>新增财务数据</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>