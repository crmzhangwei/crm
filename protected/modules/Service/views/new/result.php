<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'新分资源'=>array('list'),
	'结果页面',
);

$this->menu=array(
	 
);
?>

<h1>信息提示</h1>

<?php 
$url = Yii::app()->createUrl("Service/new/list");
echo CHtml::errorSummary($model,"<p>操作结果信息如下：</p>","<p><a href='$url'>返回列表</a></p>",null); 

?> 