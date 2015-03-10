<?php
/* @var $this CusttypeController */
/* @var $model CustType */

$this->breadcrumbs=array(
	'Cust Types'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CustType', 'url'=>array('index')),
	array('label'=>'Create CustType', 'url'=>array('create')),
	array('label'=>'View CustType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CustType', 'url'=>array('admin')),
);
?>

<h1>Update CustType <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>