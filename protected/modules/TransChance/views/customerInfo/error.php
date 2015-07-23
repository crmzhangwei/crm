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

<h1>操作失败</h1>

<?php 
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'merge-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'action' => Yii::app()->controller->createUrl('merge'),
    'enableAjaxValidation' => false,
        ));
echo $form->errorSummary($model);  
$this->endWidget();
$url = Yii::app()->createUrl("Chance/customerInfo/admin");
echo "<p><a href='$url'>返回列表</a></p>";

?> 