<?php
/* @var $this DeptInfoController */
/* @var $model DeptInfo */

$this->breadcrumbs=array(
	'Dept Infos'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DeptInfo', 'url'=>array('index')),
	array('label'=>'Create DeptInfo', 'url'=>array('create')),
	array('label'=>'View DeptInfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DeptInfo', 'url'=>array('admin')),
);
?>

<h1>Update DeptInfo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>