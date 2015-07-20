<?php
$this->breadcrumbs = array(
    '权限管理' => array('admin'),
    '短信模板管理',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#NoteTemplate-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

	<div class="btn-group">
		<a href="javascript:void(0)" id="add_customer" class="btn btn-sm btn-primary" > 
			<i class="icon-plus"></i>添加短信模板
		</a>
	</div>   

<?php
$dataProvider = $model->search();
$dataProvider->pagination->pageVar = 'page';
$this->widget('GGridView', array(
    'id' => 'NoteTemplate-grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array('class' => 'CCheckBoxColumn',
            'name' => 'id',
            'id' => 'select',
            'selectableRows' => 0,
            'headerTemplate' => '{item}',
            'htmlOptions' => array(
                'width' => '20',
            ),
        ),
        'id',
        'tname',
        'content',
        array(
			'class'=>'CButtonColumn',
			'deleteButtonOptions'=>array(),
			'viewButtonOptions'=>array('style'=>'background-color:red'),
			'header' => '操作', 
			'template'=>'{upda} {delete}',
			'htmlOptions' => array(
				'width' => '80',
				'style' => 'text-align:center',
			),
			'buttons'=>array(
				'upda'=>array(
					'label'=>'修改',
					'url'=>'',
					'imageUrl'=>'',
					'options'=>array('class'=>'editNode btn btn-info btn-minier tooltip-info','data-placement'=>"bottom",'onclick'=>"updatarow(this)"),
				),
			)          
		),
    ),
));
?>

<div class="table-page"> 
    <div class="col-sm-6">
        共<span class="orange"><?= $dataProvider->totalItemCount ?></span>条记录
    </div>
    <div class="col-sm-6 no-padding-right">
        <?php
        $this->widget('GLinkPager', array('pages' => $dataProvider->pagination,));
        ?>
    </div>
</div>

<script>
	function updatarow(obj)
	{
		var trindex = $(obj).parents('tr').index();
		var id = $('#select_'+trindex).val();
		var url;
		<?php $a = Yii::app()->createurl('User/NoteTemplate/update'); echo 'url='."'$a'"; ?> 
		public.dialog('修改短信',url+'&id='+id);
	}
	
	$('#add_customer').click(function()
	{
	   public.dialog('添加短信模板', '<?= Yii::app()->createUrl("User/NoteTemplate/create") ?>',{},700);
	});
</script>