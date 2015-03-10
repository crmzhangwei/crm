<?php
/* @var $this DicController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dics',
);

$this->menu=array(
	array('label'=>'Create Dic', 'url'=>array('create')),
	array('label'=>'Manage Dic', 'url'=>array('admin')),
);
?>

<h1>Dics</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
