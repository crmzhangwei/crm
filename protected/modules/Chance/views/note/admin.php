<?php
/* @var $this NoteController */
/* @var $model NoteInfo */

$this->breadcrumbs=array(
	'Note Infos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List NoteInfo', 'url'=>array('index')),
	array('label'=>'Create NoteInfo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#note-info-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Note Infos</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'note-info-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'cust_id',
		'cust_info',
		'requirement',
		'service',
		'dissent',
		/*
		'next_followup',
		'memo',
		'isvalid',
		'iskey',
		'next_contact',
		'dial_id',
		'eno',
		'create_time',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
