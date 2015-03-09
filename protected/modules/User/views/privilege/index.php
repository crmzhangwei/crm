<?php
/* @var $this PrivilegeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Privileges',
);

$this->menu=array(
	array('label'=>'Create Privilege', 'url'=>array('create')),
	array('label'=>'Manage Privilege', 'url'=>array('admin')),
);
?>

<h1>Privileges</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
