
<?php
/* @var $this DeptInfoController */
/* @var $model DeptInfo */
$this->pageTitle='组别管理';
$this->breadcrumbs=array(
	'组别管理'=>array('admin'),
	'管理',
);

?>
<div class="form-group">
	<div class="btn-group">
		<a href="javascript:void(0)" id ='create_group'  class="btn btn-sm btn-primary" > 
			<i class="icon-plus"></i>新建组别
		</a>
	</div>        
</div>
<?php  
$dataProvider = $model->search();
$dataProvider->pagination->pageVar = 'page';
?><div style="width:50%"><?php
$this->widget('GGridView', array(
	'id'=>'group-info-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
                    array('class'=>'CCheckBoxColumn',
                    'name'=>'id',
                   'id'=>'select',
                    'selectableRows'=>2,
                   'headerTemplate'=>'{item}',
                    'htmlOptions'=>array(
                       'width'=>'20',
                   ),
                   ), 
		'id',
		'name',
		array(
                    'class'=>'CButtonColumn',
                    'header' => '操作', 
                    'template'=>'{upda} {delete}',
                    'htmlOptions' => array(
                   'width' => '100',
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
?></div>
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
    
    $(function ()
    {
        $('#create_group').click(function ()
        {
            public.dialog('增加组别', '<?= Yii::app()->createUrl('User/groupinfo/create') ?>')
        })
    })
    
      function updatarow(obj)
     {
         
         var trindex = $(obj).parents('tr').index();
         var id = $('#select_'+trindex).val();
         var url;
         <?php $a = Yii::app()->createurl('User/groupinfo/update/'); echo 'url='."'$a'"; ?> 
         public.dialog('修改组别',url+'&id='+id);
     }
</script>















