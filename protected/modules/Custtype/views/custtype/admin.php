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
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cust-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>null,
	'columns'=>array(
		'id',
		'lib_type',
		'type_no',
		'type_name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
