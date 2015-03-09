<?php
/* @var $this RoleInfoController */
/* @var $model RoleInfo */

$this->breadcrumbs=array(
	'Role Infos'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RoleInfo', 'url'=>array('index')),
	array('label'=>'Create RoleInfo', 'url'=>array('create')),
	array('label'=>'View RoleInfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RoleInfo', 'url'=>array('admin')),
);
?>

<h1>Update RoleInfo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>