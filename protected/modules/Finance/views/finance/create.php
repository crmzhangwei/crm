<?php
/* @var $this FinanceController */
/* @var $model Finance */

$this->breadcrumbs=array(
	'财务数据'=>array('index'),
	'添加',
);

$this->menu=array(
	 
);
Yii::app()->clientScript->registerScript('search', "
 
");
?> 

<?php $this->renderPartial('_form', array('model'=>$model)); ?>