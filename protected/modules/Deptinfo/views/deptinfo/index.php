<?php
/* @var $this DeptinfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Deptinfos',
);

$this->menu=array(
	array('label'=>'Create Deptinfo', 'url'=>array('create')),
	array('label'=>'Manage Deptinfo', 'url'=>array('admin')),
);
?>

<h1>Deptinfos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
