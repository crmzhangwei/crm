<?php
/* @var $this CusttypeController */
/* @var $model CustType */

$this->breadcrumbs=array(
	'客户分类'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'修改',
);

$this->menu=array(
	array('label'=>'List CustType', 'url'=>array('index')),
	array('label'=>'Create CustType', 'url'=>array('create')),
	array('label'=>'View CustType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CustType', 'url'=>array('admin')),
);
?>

<h1>修改客户分类 <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>