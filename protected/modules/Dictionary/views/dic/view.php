<?php
/* @var $this DicController */
/* @var $model Dic */

$this->breadcrumbs=array(
	'字典数据'=>array('index'),
	$model->name,
);

$this->menu=array(
	 
);
?>

<h1>View Dic #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'name',
		'ctype',
	),
)); ?>
