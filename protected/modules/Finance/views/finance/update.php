<?php
/* @var $this FinanceController */
/* @var $model Finance */

$this->breadcrumbs=array(
	'财务数据'=>array('index'), 
	'修改',
);

$this->menu=array(
	 
);
?> 

<?php $this->renderPartial('_form', array('model'=>$model)); ?>