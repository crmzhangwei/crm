<?php
/* @var $this CustomerInfoController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'安排联系机会'=>array('admin'),
	'客户详情',
);

?>
<?php $this->renderPartial('_form', array('model'=>$model,'user'=>$user,'noteinfo'=>!empty($noteinfo)?$noteinfo:'','historyNote' => !empty($historyNote)?$historyNote:'','sharedNote' => !empty($sharedNote)?$sharedNote:'')); ?>