<?php
/* @var $this DeptGroupController */
/* @var $model DeptGroup */

$this->breadcrumbs=array(
	'Dept Groups'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DeptGroup', 'url'=>array('index')),
	array('label'=>'Create DeptGroup', 'url'=>array('create')),
	array('label'=>'View DeptGroup', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DeptGroup', 'url'=>array('admin')),
);
?>

<h1>Update DeptGroup <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>