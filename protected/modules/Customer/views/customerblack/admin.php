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
        'id'=>'form1',
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
       <div class="form-group">
            <?php echo $form->labelEx($model,'cust_type').': ';?>
            <?php echo $form->dropDownList($model,'cust_type',$custtype);?>
			
			<?php echo $form->dropDownList($model, 'searchtype', CustomerBlack::getsearchArr(), array('style' => "height:34px;")); ?>
			<?php echo $form->textField($model, 'keyword', array('size' => 25, 'maxlength' => 25)); ?>
           <br/><br/>
           创建时间:
           <?php echo $form->hiddenField($model, 'timetype', array("id" => "id_timetype")); ?> 
                <button class="btn btn-sm btn-primary" type="button" onclick="subCotact(1);"> 
                    昨天
                </button>
                <button class="btn btn-sm btn-primary" type="button" onclick="subCotact(2);"> 
                    最近7天
                </button>
                <button class="btn btn-sm btn-primary" type="button" onclick="subCotact(3);"> 
                    最近30天
                </button>
                &nbsp;&nbsp;自定义:
                <?php echo $form->textField($model, 'stime', array('size' => 25, 'maxlength' => 25, 'onclick' => 'WdatePicker()')); ?> 
                to  
                <?php echo $form->textField($model, 'etime', array('size' => 25, 'maxlength' => 25, 'onclick' => 'WdatePicker()')); ?>  
            <button class="btn btn-sm btn-primary" type="button" onclick="subCotact(0);">
            <i class="icon-search"></i>
            搜 索
            </button>
		   
			<div class="btn-group" style="float:right;">
				<a href="javascript:void(0)" id="out_excel" class="btn btn-sm btn-primary" > 
					<i class="icon-plus"></i>导出EXCEL
				</a>
			</div> 
        </div>

<?php $this->endWidget(); ?>

<?php 
	$dataProvider = $model->search();
	$dataProvider->pagination->pageVar = 'page';
	$dataProvider->pagination->pageSize = $aPageSize;
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
		array('name'=>'eno', 'value'=>array($this, 'get_eno_text')),
		//array('name'=>'last_time', 'value'=>'date("Y-m-d H:i:s",$data->last_time)',),
		array('name'=>'last_time', 'value'=>array($this, 'get_last_time'),),
		'cust_name',
		array('name'=>'old_cust_type', 'value'=>array($this, 'get_old_cust_type')),
		'shop_name',
		'phone',
		//array('name' => 'phone', 'value' => 'substr_replace($data->phone,"****",3,4)'),
		array('name' => 'qq', 'value' => 'substr_replace($data->qq,"****",3,4)'),
		array('name' => 'mail', 'value' => 'substr_replace($data->mail,"****",0,4)'),
		//array('name'=>'assign_time', 'value'=>'date("Y-m-d H:i:s",$data->assign_time)',),
		//array('name'=>'next_time', 'value'=>'date("Y-m-d H:i:s",$data->assign_time)',),
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
		<a href="javascript:void(0);" js_type="publish"  col='0' class="btn  btn-minier btn-sm btn-success publish"><i class=" icon-ok icon-large"></i>领取资源</a> 
        共<span class="orange"><?=$dataProvider->totalItemCount ?></span>条记录, 每页显示
		<?php echo CHtml::dropDownList('apageSize', isset($_SESSION['uPageSize'])?$_SESSION['uPageSize']:10, UserInfo::getPagesize(), array('onchange'=>"pageSizeShow()",'id'=>'pageSizeShow','style' => "height:23px;")); ?>条
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
	
	$('#out_excel').click(function()
	{
		var sourceUrl = window.location.href;
		location.href=sourceUrl+"&out=1";
	});
    function subCotact(timetype) {
        $("#id_timetype").val(timetype);
        $("#form1").submit();
    }
</script>

<?php
	/*
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
	 */
?>

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
		public.dialog('客户资源分配', "$diaolog",{'ids':ids,'flag':1},700);
   });
 });
EOF;
Yii::app()->clientScript->registerScript('topicjss', $jss);
?>

<script src="/static/js/secondlevel.js"></script>