<?php
/* @var $this MenuInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Menu Infos',
);

$this->menu=array(
	array('label'=>'Create MenuInfo', 'url'=>array('create')),
	array('label'=>'Manage MenuInfo', 'url'=>array('admin')),
);
?>

<h1>Menu Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
