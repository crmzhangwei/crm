<?php
/* @var $this FinanceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Finances',
);

$this->menu=array(
	array('label'=>'Create Finance', 'url'=>array('create')),
	array('label'=>'Manage Finance', 'url'=>array('admin')),
);
?>

<h1>Finances</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
