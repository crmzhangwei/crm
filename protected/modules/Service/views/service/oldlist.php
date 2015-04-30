<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'售后管理'=>array('index'),
	'遗留数据',
);

$this->menu=array( 
);

Yii::app()->clientScript->registerScript('search', " 
$('.search-form form').submit(function(){
	$('#service-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>售后-遗留数据</h1> 
<div class="search-form" style="display:">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$dataProvider=$model->searchOldList();
$this->widget('GGridView', array(
	'id'=>'service-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>null,
	'columns'=>array(
		'id',   
                array('name'=>'cust_id','value'=>'$data->cust_name'),
                array('name'=>'cust_type','value'=>'$data->cust_type_name'),
		'qq',
		'webchat',
                'ww',
                array('name'=>'category','value'=>'$data->category_name'),
                'service_limit',
		/*
		'shop_addr',
		'phone',
		'qq',
		'mail',
		'datafrom',
		'category',
		'cust_type',
		'eno',
		'iskey',
		'assign_eno',
		'assign_time',
		'next_time',
		'memo',
		'create_time',
		'creator',
		*/
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{update}', 
                        'updateButtonLabel'=>'查看客户详情'
		),
	),
)); ?>

<div class="table-page"> 
    <div class="col-sm-6">
        共<span class="orange"><?=$dataProvider->totalItemCount ?></span>条记录 
    </div>
    <div class="col-sm-6 no-padding-right">
        <?php 
        $this->widget('GLinkPager', array('pages' => $dataProvider->getPagination(),));
        ?>
    </div>
</div>
