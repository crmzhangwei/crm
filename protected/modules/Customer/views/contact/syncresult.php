<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'安排联系机会'=>array('admin'),
	'同步结果页面',
);

$this->menu=array(
	 
);
?>

<h1>操作提示</h1>
 
<font color="red"><?php echo Yii::app()->user->getFlash('success');  ?></font> 
<?php  
echo "<p><a href='index.php?r=Customer/contact/index' >返回列表</a></p>";
?> 