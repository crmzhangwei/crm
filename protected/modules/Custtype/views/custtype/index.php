<?php
/* @var $this CusttypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'客户分类',
);

$this->menu=array(
	 
);
?>

<h1>客户分类</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
