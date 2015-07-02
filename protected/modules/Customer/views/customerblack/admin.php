<?php
/* @var $this CustomerblackController */
/* @var $model Customerblack */

$this->breadcrumbs = array(
	'客户管理' => array('admin'),
	'公海资源',
);

/*$this->menu=array(
	array('label'=>'List CustomerBlack', 'url'=>array('index')),
	array('label'=>'Create CustomerBlack', 'url'=>array('create')),
);*/

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
            <?php echo $form->labelEx($model,'cust_type').': ';?>
            <?php echo $form->dropDownList($model,'cust_type',$custtype);?>
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
		'id'=>'CustomerBlack-grid',
		'dataProvider'=>$dataProvider,
		'columns'=>array(
			array('class' => 'CCheckBoxColumn',
				'name' => 'id',
				'id' => 'select',
				'selectableRows' => 2,
				'headerTemplate' => '{item}',
				'htmlOptions' => array(
					'width' => '20',
				),
			),
		'cust_name',
		array('name'=>'old_custtype', 'value'=>array($this, 'get_cust_type')),
		'corp_name',
		'shop_name',
		'shop_url',
		'shop_addr',
		array('name' => 'phone', 'value' => 'substr_replace($data->phone,"****",3,4)'),
		array('name' => 'qq', 'value' => 'substr_replace($data->qq,"****",3,4)'),
		array('name' => 'mail', 'value' => 'substr_replace($data->mail,"****",0,4)'),
		array('name'=>'assign_time', 'value'=>'date("Y-m-d H:i:s",$data->assign_time)',),
		array('name'=>'next_time', 'value'=>'date("Y-m-d H:i:s",$data->assign_time)',),
		/*array(
			'class'=>'CButtonColumn',
						'deleteButtonOptions'=>array('style'=>'display:none'),
						'htmlOptions'=>array(
						'width'=>'100',
						'style'=>'text-align:center',
				),
		),*/
	),
)); ?>

<div class="table-page"> 
    <div class="col-sm-6">
        共<span class="orange"><?=$dataProvider->totalItemCount ?></span>条记录
		<a href="javascript:void(0);" js_type="publish"  col='0' class="btn  btn-minier btn-sm btn-success publish"><i class=" icon-ok icon-large"></i>领取资源</a>
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
	$before = Yii::app()->createUrl("Customer/customerblack/admin");
	$jss = <<<EOF
	$(function () {

	$(".publish").click(function () {
		var ids = getIds($('input[name="select[]"]:checked'));
		if (!ids) {
			bootbox.alert('请选择需要领取的资源！');
			return;
		}
		$.post("./index.php?r=Customer/customerblack/GetResource",{'ids':ids},function(data)
	    {
	    	if(data){
				alert("恭喜你, 领取资源成功。");window.location.href="$before";
			}
			else{
				alert("对不起, 领取资源失败, 请再试一次。");window.location.href="$before";
			}
	    },'json')
   });
 });
EOF;
Yii::app()->clientScript->registerScript('topicjss', $jss);
?>
