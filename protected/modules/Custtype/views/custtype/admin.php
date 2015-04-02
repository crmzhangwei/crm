<?php
/* @var $this CusttypeController */
/* @var $model CustType */

$this->breadcrumbs=array(
	'客户分类'=>array('index'),
	'管理',
);

$this->menu=array( 
	array('label'=>'增加客户分类', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cust-type-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>客户分类信息</h1>

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
<p>
<?php
$this->widget('zii.widgets.CMenu', array('items'=> $this->menu));
?>
</p>
<?php 
$dataProvider = $model->search(); 
$this->widget('GGridView', array(
	'id'=>'cust-type-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>null,
	'columns'=>array(
		'id', 
                array('name'=>'lib_type','value'=>'$data->lib_type_name'),
		'type_no',
		'type_name',
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
