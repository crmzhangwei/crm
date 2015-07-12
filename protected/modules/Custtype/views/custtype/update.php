<?php
/* @var $this CusttypeController */
/* @var $model CustType */

$this->breadcrumbs=array(
	'客户分类'=>array('admin'), 
	'修改',
);

$this->menu=array(
	 
);
?>

<h1>修改客户分类 </h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>