<?php
/* @var $this RoleInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Role Infos',
);

$this->menu=array(
	array('label'=>'Create RoleInfo', 'url'=>array('create')),
	array('label'=>'Manage RoleInfo', 'url'=>array('admin')),
);
?>

<h1>Role Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
