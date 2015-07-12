<?php
/* @var $this CusttypeController */
/* @var $model CustType */

$this->breadcrumbs=array(
	'客户分类'=>array('admin'),
	$model->id,
);

$this->menu=array(
	 
);
?>

<h1>查看客户分类 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'lib_type',
		'type_no',
		'type_name',
	),
)); ?>
