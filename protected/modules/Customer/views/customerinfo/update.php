<?php
/* @var $this CustomerinfoController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'Customer Infos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);


?>



<?php $this->renderPartial('_form', array('model'=>$model, 'category'=>$category, 'deptArr'=>$deptArr,'user_info'=>$user_info)); ?>