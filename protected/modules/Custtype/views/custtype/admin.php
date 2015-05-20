<?php
/* @var $this CusttypeController */
/* @var $model CustType */

$this->breadcrumbs=array(
	'客户分类'=>array('admin'),
	'管理',
);

$this->menu=array( 
	 
);

Yii::app()->clientScript->registerScript('search', "
 
 $('#search_cust_type').click(function(){
    $('.search-form form').submit();
    return false;
 });
");
?> 
<div class="search-form" style="display:">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
 
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
