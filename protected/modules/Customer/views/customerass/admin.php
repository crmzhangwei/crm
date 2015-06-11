<?php
/* @var $this CustomerassController */
/* @var $model CustomerAss */

$this->breadcrumbs = array(
	'客户管理' => array('admin'),
	'客户资源分配',
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
            <?php echo $form->dropDownList($model,'searchtype',CustomerAss::getsearchArr(),array('style'=>"height:34px;"));?>
            <?php echo $form->textField($model,'keyword',array('size'=>30,'maxlength'=>30));?>
			<?php echo $form->label($model, 'cust_type');echo ':'; ?>
			<?php echo $form->dropDownList($model,'cust_type',$custtype,array('style'=>"height:34px;"));?>
            <button class="btn btn-sm btn-primary" type="submit">
            <i class="icon-search"></i>
            搜 索
            </button>
        </div>

<?php $this->endWidget(); ?>

<?php 
        $dataProvider = $model->search();
		$dataProvider->pagination->pageVar = 'page';
        $this->widget('GGridView', array(
			'id'=>'CustomerAss-grid',
			'dataProvider'=>$dataProvider,
			'rowCssClassExpression' => '
				( $row%2 ? $this->rowCssClass[1] : $this->rowCssClass[0] ) .
				( $data->iskey ?  " red":null  )'
			,
			'columns'=>array(
			array(
				'class' => 'CCheckBoxColumn',
				'name' => 'id',
				'id' => 'select',
				'selectableRows' => 2,
				'headerTemplate' => '{item}',
				'htmlOptions' => array(
					'width' => '20',
				),
			),
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
			'cust_type',
			array('name'=>'eno', 'value'=>array($this, 'get_eno_text')),
			array('name'=>'assign_eno', 'value'=>array($this, 'get_assign_text')),
			array('name'=>'assign_time', 'value'=>array($this, 'formatDate'),),
			/*array(
				'class'=>'CButtonColumn',
							'deleteButtonOptions'=>array('style'=>'display:none'),
							'viewButtonOptions'=>array('style'=>'display:none'),
							'htmlOptions'=>array(
							'width'=>'50',
							'style'=>'text-align:center',
					),
			),*/
	),
)); ?>

<div class="table-page"> 
    <div class="col-sm-6">
        共<span class="orange"><?=$dataProvider->totalItemCount ?></span>条记录
		<a href="javascript:void(0);" js_type="publish"  col='0' class="btn  btn-minier btn-sm btn-success publish"><i class=" icon-ok icon-large"></i>分配资源</a> 
    </div>
    <div class="col-sm-6 no-padding-right">
        <?php
        $dataProvider->pagination->pageVar = 'page';
        $this->widget('GLinkPager', array('pages' => $dataProvider->pagination,));
        ?>
    </div>
</div>
<script>
function getIds(dom){
        var ids = '';
        dom.each(function (index, element) {
                ids += ',' + $(this).val();
        });
        return  ids.substring(1);
    }
</script>

<?php
	//$publishUrl = Yii::app()->createUrl("/User/users/publish/",array('ajax'=>'1'));
	$diaolog = Yii::app()->createUrl("Customer/customerass/assign");
	$jss = <<<EOF
	$(function () {

	$(".publish").click(function () {
		var ids = getIds($('input[name="select[]"]:checked'));
		if (!ids) {
			bootbox.alert('请选择需要分配的资源！');
			return;
		}
		public.dialog('客户资源分配', "$diaolog",{'ids':ids},700);
   });
 });
EOF;
Yii::app()->clientScript->registerScript('topicjss', $jss);
?>