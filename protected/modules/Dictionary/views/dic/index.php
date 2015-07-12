<?php
/* @var $this DicController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'字典数据',
);

$this->menu=array( 
);
?>

<h1>Dics</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
