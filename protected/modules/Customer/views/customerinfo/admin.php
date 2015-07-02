<?php
/* @var $this CustomerinfoController */
/* @var $model CustomerInfo */
$this->breadcrumbs = array(
	'客户管理' => array('admin'),
	'查询分配',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#customer-info-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!-- search-form -->

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
       <div class="form-group">
             <div class="btn-group">
                <a href="javascript:void(0)" id="add_customer" class="btn btn-sm btn-primary" > 
                    <i class="icon-plus"></i>添加客户
                </a>
             </div>        

             <?php echo $form->dropDownList($model,'searchtype',CustomerInfo::getsearchArr(),array('style'=>"height:34px;"));?>
             <?php echo $form->textField($model,'keyword',array('size'=>30,'maxlength'=>30));?>
            
             <button class="btn btn-sm btn-primary" type="submit">
            <i class="icon-search"></i>
            搜 索
            </button>
            
            <div class="btn-group" style="float:right;">
                <a href="javascript:void(0)" id="batch_input" class="btn btn-sm btn-primary" > 
                    <i class="icon-plus"></i>EXCEL批量导入
                </a>
				<a href="<?= Yii::app()->createUrl("Customer/customerinfo/getTemplate") ?>">下载<br>模板</a>
            </div> 
        </div>

<?php $this->endWidget(); ?>

<?php 
	$dataProvider = $model->search();
	$dataProvider->pagination->pageVar = 'page';
	$this->widget('GGridView', array(
		'id'=>'CustomerInfo-grid',
		'dataProvider'=>$dataProvider,
		'rowCssClassExpression' => '
			( $row%2 ? $this->rowCssClass[1] : $this->rowCssClass[0] ) .
			( $data->iskey ?  " red":null  )
		',
		'columns'=>array(
			array('class' => 'CCheckBoxColumn',
				'name' => 'id',
				'id' => 'select',
				'selectableRows' => 0,
				'headerTemplate' => '{item}',
				'htmlOptions' => array(
					'width' => '20',
				),
			),
		//'id',
		'cust_name',
		'shop_name',
		'shop_url',
		'shop_addr',
		array('name' => 'phone', 'value' => 'substr_replace($data->phone,"****",3,4)'),
		array('name' => 'qq', 'value' => 'substr_replace($data->qq,"****",3,4)'),
		array('name'=>'category', 'value'=>array($this, 'get_category_text')),
		array('name' => 'mail', 'value' => 'substr_replace($data->mail,"****",0,4)'),
		//'eno',
		array('name'=>'eno', 'value'=>array($this, 'get_eno_text')),
		array('name'=>'assign_eno', 'value'=>array($this, 'get_assign_text')),
		array('name'=>'assign_time', 'value'=>array($this, 'get_assign_time'),),
		/*array(
			'class'=>'CButtonColumn',
				//'deleteButtonOptions'=>array('style'=>'display:none'),
				'viewButtonOptions'=>array('style'=>'display:none'),
				'htmlOptions'=>array(
				'width'=>'50',
				'style'=>'text-align:center',
				),
		),*/
		array(
			'class'=>'CButtonColumn',
			'deleteButtonOptions'=>array(),
			'viewButtonOptions'=>array('style'=>'background-color:red'),
			'header' => '操作', 
			'template'=>'{upda} {delete}',
			'htmlOptions' => array(
				'width' => '50',
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
)); ?>

<div class="table-page"> 
    <div class="col-sm-6">
        共<span class="orange"><?=$dataProvider->totalItemCount ?></span>条记录
    </div>
    <div class="col-sm-6 no-padding-right">
        <?php
        $this->widget('GLinkPager', array('pages' => $dataProvider->pagination,));
        ?>
    </div>
</div>

<script>
    $(function()
    {
        $('#add_customer').click(function()
        {
           public.dialog('添加客户', '<?= Yii::app()->createUrl("Customer/customerinfo/create") ?>',{},700);
        });

        $('#batch_input').click(function()
        {
           public.dialog('EXCEL批量导入', '<?= Yii::app()->createUrl("Customer/customerinfo/batchCustomer") ?>',{},700);
        });
        
    });
	
	function updatarow(obj)
	{
		var trindex = $(obj).parents('tr').index();
		console.log(trindex);
		var id = $('#select_'+trindex).val();
		var url;
		<?php $a = Yii::app()->createurl('Customer/customerinfo/update'); echo 'url='."'$a'"; ?> 
		public.dialog('修改客户信息',url+'&id='+id);
	}
</script>  		
