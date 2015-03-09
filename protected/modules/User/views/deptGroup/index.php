<?php
/* @var $this DeptGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dept Groups',
);

$this->menu=array(
	array('label'=>'Create DeptGroup', 'url'=>array('create')),
	array('label'=>'Manage DeptGroup', 'url'=>array('admin')),
);
?>

<h1>Dept Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
