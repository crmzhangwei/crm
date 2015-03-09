<?php
/* @var $this UserRoleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Roles',
);

$this->menu=array(
	array('label'=>'Create UserRole', 'url'=>array('create')),
	array('label'=>'Manage UserRole', 'url'=>array('admin')),
);
?>

<h1>User Roles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
