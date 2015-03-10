<?php
/* @var $this DicController */
/* @var $model Dic */

$this->breadcrumbs=array(
	'字典数据'=>array('index'),
	'管理',
);

$this->menu=array( 
	array('label'=>'增加字典数据', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#dic-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>字典数据</h1>

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
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'dic-grid',
	'dataProvider'=>$model->search(),
	'filter'=>null,
	'columns'=>array(
		'id',
		'code',
		'name',
		'ctype',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
