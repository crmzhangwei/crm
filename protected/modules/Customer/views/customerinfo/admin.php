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

	<?php echo $form->dropDownList($model, 'searchtype', CustomerInfo::getsearchArr(), array('style' => "height:34px;")); ?>
	<?php echo $form->textField($model, 'keyword', array('size' => 25, 'maxlength' => 25)); ?>

	<?php echo $form->labelEx($model, 'eno'); ?>
	<?php echo CHtml::dropDownList('search[dept]', $infoArr['dept'], $deptArr, array('onchange' => 'listgroup(this)')); ?>
	<?php if(!$user_info['group_arr']):?>
	<select id="groupinfo" name="search[group]" onchange="listuser(this)">
		<option value ="0">--请选择组--</option>
	</select>
	<?php else:
		echo CHtml::dropDownList('search[group]', intval($infoArr['group']), $user_info['group_arr'], array('onchange'=>"listuser(this)",'id'=>'groupinfo'));
	endif;?>
	
	<?php if(!$user_info['user_arr']):?>
	<select id='userinfo' name="search[users]" onchange="enoval(this)">	
		<option value ="0">---请选择人员---</option>
	</select>
	<?php else:
		echo   CHtml::dropDownList('search[users]', $infoArr['users'], $user_info['user_arr'], array('id'=>"userinfo",'onchange'=>"enoval(this)"));
	endif;?>
	<div style="display: none">
	<?php echo $form->textField($model,'eno',array('size'=>5,'maxlength'=>100,'id'=>'usereno'));?> 
	</div>
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
	$dataProvider->pagination->pageSize = $aPageSize;
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
				'selectableRows' => 2,
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
		array('name'=>'next_time', 'value'=>array($this, 'get_next_time'),),
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
			'template'=>'{upda}',
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
		<?php if($isdel==1){ ?>
		<a href="javascript:void(0);" col='0' class="btn  btn-minier btn-sm btn-success publish" onclick="batch_del()">批量删除</a>
		<?php }?>
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
	
	function getIds(dom){
        var ids = '';
        dom.each(function (index, element) {
                ids += ',' + $(this).val();
        });
        return  ids.substring(1);
    }
	
	function batch_del(){
		var ids = getIds($('input[name="select[]"]:checked'));
		if (!ids) {
			bootbox.alert('请选择需要删除的资源！');
			return;
		}
		else{
			if(confirm("确认删除选中的客户资源吗?")){
				$.ajax({
					url: '<?php echo $this->createUrl('/Customer/customerinfo/batchDel');?>',
					type: 'post',
					data: {ids: ids},
					dataType: 'json',
					success: function(result){
						if(result){
							alert('恭喜你, 删除成功!');
						}
						else{
							alert('对不起, 删除失败, 请重新操作一次!');
						}
					}
				});
			}
			else{
				return;
			}
			history.go(0);
		}
	}
	
</script>  	
<script src="/static/js/secondlevel.js"></script>

