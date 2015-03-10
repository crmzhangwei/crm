<?php
/* @var $this CusttypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cust Types',
);

$this->menu=array(
	array('label'=>'Create CustType', 'url'=>array('create')),
	array('label'=>'Manage CustType', 'url'=>array('admin')),
);
?>

<h1>Cust Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
