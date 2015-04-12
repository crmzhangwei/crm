<?php
/* @var $this DeptinfoController */
/* @var $model Deptinfo */

$this->breadcrumbs=array(
	'Deptinfos'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Deptinfo', 'url'=>array('index')),
	array('label'=>'Create Deptinfo', 'url'=>array('create')),
	array('label'=>'View Deptinfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Deptinfo', 'url'=>array('admin')),
);
?>

<h1>Update Deptinfo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>