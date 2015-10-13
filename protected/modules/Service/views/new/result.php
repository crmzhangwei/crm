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
 
<h1>操作提示</h1>
 
<font color="red"><?php echo Yii::app()->user->getFlash('success');  ?></font> 
<?php  
echo "<p><a href='#' onclick='javascript:window.close();'>关闭</a></p>";
?> 