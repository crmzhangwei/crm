<?php
/* @var $this CusttypeController */
/* @var $model CustType */

$this->breadcrumbs=array(
	'Cust Types'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CustType', 'url'=>array('index')),
	array('label'=>'Create CustType', 'url'=>array('create')),
	array('label'=>'Update CustType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CustType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CustType', 'url'=>array('admin')),
);
?>

<h1>View CustType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'lib_type',
		'type_no',
		'type_name',
	),
)); ?>
