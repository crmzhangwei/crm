<?php
/* @var $this GroupInfoController */
/* @var $model GroupInfo */

$this->breadcrumbs=array(
	'Group Infos'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GroupInfo', 'url'=>array('index')),
	array('label'=>'Create GroupInfo', 'url'=>array('create')),
	array('label'=>'View GroupInfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GroupInfo', 'url'=>array('admin')),
);
?>

<h1>Update GroupInfo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>