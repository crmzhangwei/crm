<?php
/* @var $this FinanceController */
/* @var $model Finance */

$this->breadcrumbs=array(
	'财务数据'=>array('index'),
	'管理',
);

$this->menu=array( 
	array('label'=>'Create Finance', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){ 
        $('#finance-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
}); 

");
?>

<h1>财务数据</h1>

<p>
你可以在输入框的开始处输入 (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>)，用以指定查询条件.
</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php
$this->widget('zii.widgets.CMenu', array('items'=> $this->menu));
?>
<div id="search_list">
<?php 
 $dataProvider = $model->search(); 
$this->widget('GGridView', array(
	'id'=>'finance-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>null,
	'columns'=>array(
		'id', 
                array('name'=>'cust_id','value'=>'$data->cust_name'),
		array('name'=>'sale_user','value'=>'$data->sale_user_name'),
                array('name'=>'trans_user','value'=>'$data->trans_user_name'), 
		'acct_number',
		'acct_amount',
                array('name'=>'acct_time',  
                    'value'=>'date("Y-m-d",$data->acct_time)',//格式化日期  
                ),  
		/*
		'acct_time',
		'creator',
		'create_time',
		*/
		array(
			'class'=>'CButtonColumn',
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
 </div><!-- search_list-->
