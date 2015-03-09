<?php
/* @var $this MenuInfoController */
/* @var $model MenuInfo */

$this->breadcrumbs=array(
	'Menu Infos'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MenuInfo', 'url'=>array('index')),
	array('label'=>'Create MenuInfo', 'url'=>array('create')),
	array('label'=>'View MenuInfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MenuInfo', 'url'=>array('admin')),
);
?>

<h1>Update MenuInfo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>