<?php
/* @var $this CustomerinfoController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'客户管理'=>array('index'),
	'查询分配',
);

$this->menu=array(
	array('label'=>'List CustomerInfo', 'url'=>array('index')),
	array('label'=>'Create CustomerInfo', 'url'=>array('create')),
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
            </div> 
        </div>

<?php $this->endWidget(); ?>

<?php 
        $dataProvider = $model->search();
		$dataProvider->pagination->pageVar = 'page';
        $this->widget('GGridView', array(
			'id'=>'CustomerInfo-grid',
			'dataProvider'=>$dataProvider,
			'columns'=>array(
			//                array('class' => 'CCheckBoxColumn',
			//                    'name' => 'id',
			//                    'id' => 'select',
			//                    'selectableRows' => 2,
			//                    'headerTemplate' => '{item}',
			//                    'htmlOptions' => array(
			//                        'width' => '20',
			//                    ),
			//                ),
                 //'id',
			'cust_name',
			'corp_name',
            'shop_name',
			'shop_url',
			'shop_addr',
			'phone',
			'qq',
			array('name'=>'category', 'value'=>array($this, 'get_category_text')),
			'mail',
			array('name'=>'eno', 'value'=>array($this, 'get_eno_text')),
			//'assign_eno',
			array('name'=>'assign_eno', 'value'=>array($this, 'get_assign_text')),
			//'assign_time',
			array('name'=>'assign_time', 'value'=>'date("Y-m-d",$data->assign_time)',),
			array(
				'class'=>'CButtonColumn',
							'deleteButtonOptions'=>array('style'=>'display:none'),
							'htmlOptions'=>array(
							'width'=>'100',
							'style'=>'text-align:center',
					),
			),
	),
)); ?>

<div class="table-page"> 
    <div class="col-sm-6">
        共<span class="orange"><?=$dataProvider->totalItemCount ?></span>条记录
    </div>
    <div class="col-sm-6 no-padding-right">
        <?php
        $dataProvider->pagination->pageVar = 'page';
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
        
    })
</script>  		
