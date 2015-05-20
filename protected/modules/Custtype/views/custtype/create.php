<?php
/* @var $this CusttypeController */
/* @var $model CustType */

$this->breadcrumbs=array(
	'客户分类'=>array('admin'),
	'增加',
);

$this->menu=array(
 
);
?>
 
<?php $this->renderPartial('_form', array('model'=>$model)); ?>