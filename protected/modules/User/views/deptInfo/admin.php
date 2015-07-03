<?php
/* @var $this DeptInfoController */
/* @var $model DeptInfo */
$this->pageTitle = '部门管理页面';
$this->breadcrumbs=array(
	'部门管理'=>array('admin'),
	'部门管理',
);

?>
<div class="form-group">
	<div class="btn-group">
		<a href="javascript:void(0)" id ='create_dept'  class="btn btn-sm btn-primary" > 
			<i class="icon-plus"></i>新建部门
		</a>
	</div>        
</div>
<?php  
$dataProvider = $model->search();
$dataProvider->pagination->pageVar = 'page';
?><div style="width:50%"><?php
$this->widget('GGridView', array(
	'id'=>'dept-info-grid',
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
                array('name'=>'parent_id', 'value'=>array($this, 'get_parent_text')),
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
        $('#create_dept').click(function ()
        {
            public.dialog('增加部门', '<?= Yii::app()->createUrl('User/deptinfo/create') ?>')
        })
    })
    
      function updatarow(obj)
     {
         
         var trindex = $(obj).parents('tr').index();
         console.log(trindex);
         var id = $('#select_'+trindex).val();
         var url;
         <?php $a = Yii::app()->createurl('User/deptinfo/update/'); echo 'url='."'$a'"; ?> 
         public.dialog('修改部门',url+'&id='+id);
     }
</script>



