<?php
/* @var $this PrivilegeController */
/* @var $model Privilege */

$this->breadcrumbs=array(
	'Privileges'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Privilege', 'url'=>array('index')),
	array('label'=>'Create Privilege', 'url'=>array('create')),
	array('label'=>'View Privilege', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Privilege', 'url'=>array('admin')),
);
?>

<h1>Update Privilege <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>