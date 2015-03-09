<?php
/* @var $this GroupInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Group Infos',
);

$this->menu=array(
	array('label'=>'Create GroupInfo', 'url'=>array('create')),
	array('label'=>'Manage GroupInfo', 'url'=>array('admin')),
);
?>

<h1>Group Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
