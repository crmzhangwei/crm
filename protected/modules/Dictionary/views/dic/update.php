<?php
/* @var $this DicController */
/* @var $model Dic */

$this->breadcrumbs=array(
	'字典数据'=>array('index'), 
	'修改',
);

$this->menu=array( 
);
?>

<h1>修改字典数据 <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>