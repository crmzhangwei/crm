<?php
/* @var $this DicController */
/* @var $model Dic */

$this->breadcrumbs=array(
	'Dics'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Dic', 'url'=>array('index')),
	array('label'=>'Create Dic', 'url'=>array('create')),
	array('label'=>'View Dic', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Dic', 'url'=>array('admin')),
);
?>

<h1>修改字典数据 <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>