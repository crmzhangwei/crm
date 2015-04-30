<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'售后-查询分配'=>array('admin'),
	'结果页面',
);

$this->menu=array(
	 
);
?>

<h1>信息提示</h1>

<?php 
$url = Yii::app()->createUrl("Service/service/admin");
echo CHtml::errorSummary($model,"<p>操作结果信息如下：</p>","<p><a href='$url'>返回</a></p>",null); 

?> 