<?php
/* @var $this DeptInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dept Infos',
);

$this->menu=array(
	array('label'=>'Create DeptInfo', 'url'=>array('create')),
	array('label'=>'Manage DeptInfo', 'url'=>array('admin')),
);
?>

<h1>Dept Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
