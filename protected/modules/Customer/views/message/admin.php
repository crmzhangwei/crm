<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'客户管理'=>array('admin'),
	'短信记录',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#message-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<script type="text/javascript">
function resend(obj){ 
    var trindex = $(obj).parents('tr').index(); 
    var id = $('#select_'+trindex).val();
    $.getJSON('<?= Yii::app()->createUrl('Customer/message/resend') ?>',{'id':id},function(result){
        alert(result.msg);
    }); 
}
</script>
<!-- search-form -->

<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>

<div class="form-group">
    <?php echo $form->dropDownList($model, 'searchtype', Message::getsearchArr(), array('style' => "height:34px;")); ?>
	<?php echo $form->textField($model, 'keyword', array('size' => 30, 'maxlength' => 30)); ?>   
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
    'id' => 'Message-grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array('class' => 'CCheckBoxColumn',
				'name' => 'id',
				'id' => 'select',
				'selectableRows' => 2,
				'headerTemplate' => '{item}',
				'htmlOptions' => array(
					'width' => '20',
				),
			),
        'phone',
        'content',
		'memo',
		//'create_time',
		array('name' => 'create_time', 'value' => 'date("Y-m-d H:i:s",$data->create_time)'),
		//'creator',
		array('name'=>'creator', 'value'=>array($this, 'get_creator_text')),
        array(
			'class'=>'CButtonColumn',
			'deleteButtonOptions'=>array(),
			'viewButtonOptions'=>array('style'=>'background-color:red'),
			'header' => '操作', 
			'template'=>'{upda}',
			'htmlOptions' => array(
				'width' => '50',
				'style' => 'text-align:center',
			),
			'buttons'=>array(
				'upda'=>array(
					'label'=>'重新发送',
					'url'=>'',
					'imageUrl'=>'',
					'options'=>array('class'=>'editNode btn btn-info btn-minier tooltip-info','data-placement'=>"bottom",'onclick'=>"resend(this)"),
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




