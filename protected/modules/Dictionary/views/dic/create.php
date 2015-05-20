<?php
/* @var $this DicController */
/* @var $model Dic */

$this->breadcrumbs=array(
	'字典数据'=>array('admin'),
	'添加',
);

$this->menu=array(
	 
);
?>
 

<?php $this->renderPartial('_form', array('model'=>$model)); ?>