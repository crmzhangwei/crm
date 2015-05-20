<?php
/* @var $this FinanceController */
/* @var $model Finance */

$this->breadcrumbs=array(
	'财务数据'=>array('index'),
	$model->id,
);

$this->menu=array(
	 
);
?> 

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cust_id',
		'sale_user',
		'trans_user',
		'acct_number',
		'acct_amount',
		'acct_time',
		'creator',
		'create_time',
	),
)); ?>
