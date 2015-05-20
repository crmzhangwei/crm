<?php
/* @var $this FinanceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'财务数据查询',
);

$this->menu=array(
	 
);
?>
 
<?php
$this->widget('zii.widgets.CMenu', array('items'=> $this->menu));
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'users-grid',
'dataProvider'=>$dataProvider,
'filter'=>null,
'columns'=>array(
'id',
'cust_id',
'sale_user',
'trans_user',
'acct_number',
'acct_amount',
'acct_time',
'creator', 
'create_time',
array( 
'class'=>'CButtonColumn',

),

),

)); ?>
