<?php
/* @var $this CustomerInfoController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'Customer Infos'=>array('index'),
	'Create',
);

?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>