<?php
/* @var $this GroupInfoController */
/* @var $model GroupInfo */

$this->breadcrumbs=array(
	'Group Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GroupInfo', 'url'=>array('index')),
	array('label'=>'Manage GroupInfo', 'url'=>array('admin')),
);
?>

<h1>Create GroupInfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>