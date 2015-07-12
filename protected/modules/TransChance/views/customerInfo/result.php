<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'安排联系机会'=>array('admin'),
	'结果页面',
);

$this->menu=array(
	 
);
?>

<h1>操作成功</h1>

<?php 
$url = Yii::app()->createUrl("TransChance/customerInfo/admin");
echo "<p><a href='$url'>返回列表</a></p>"; 

?> 