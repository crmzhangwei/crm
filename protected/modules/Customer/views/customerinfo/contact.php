<?php
/* @var $this CustomerinfoController */
/* @var $model CustomerInfo */
$this->breadcrumbs = array(
    '客户管理' => array('admin'),
    '联系记录',
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

<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'id'=>"form1",
        ));
?>
<div class="form-group"> 
    <table class="table table-bordered" width="50%">
        <tr>
            <td width="3%">部门/组别</td>
            <td width="30%">
                <?php echo CHtml::dropDownList('search[dept]', $infoArr['dept'], $deptArr, array('onchange' => 'listgroup(this)')); ?>
                <?php if (!$user_info['group_arr']): ?>
                    <select id="groupinfo" name="search[group]" onchange="listuser(this)">
                        <option value ="0">--请选择组--</option>
                    </select>
                    <?php
                else:
                    echo CHtml::dropDownList('search[group]', intval($infoArr['group']), $user_info['group_arr'], array('onchange' => "listuser(this)", 'id' => 'groupinfo'));
                endif;
                ?> 
            </td>
        </tr>
        <tr>
            <td>统计时间</td>
            <td>
                <?php echo $form->hiddenField($model, 'timetype',array("id"=>"id_timetype")); ?> 
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
                <?php echo $form->textField($model, 'stime', array('size' => 25, 'maxlength' => 25,'onclick'=>'WdatePicker()')); ?> 
                to  
                <?php echo $form->textField($model, 'etime', array('size' => 25, 'maxlength' => 25,'onclick'=>'WdatePicker()')); ?>  
            </td>
        </tr>
        <tr>
            <td><?php echo $form->dropDownList($model, 'searchtype', array('1' => '联系人', '2' => '客户名称', '3' => '电话号码'), array('style' => "height:34px;")); ?></td>
            <td><?php echo $form->textField($model, 'keyword', array('size' => 25, 'maxlength' => 25)); ?></td>
        </tr>
    </table> 
    <button class="btn btn-sm btn-primary" type="button" onclick="subCotact(0);">
        <i class="icon-search"></i>
        搜 索
    </button>

</div>

<?php $this->endWidget(); ?>

<?php
$dataProvider = $model->search();
$dataProvider->pagination->pageVar = 'page';
$this->widget('GGridView', array(
    'id' => 'CustomerInfo-grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array('class' => 'CCheckBoxColumn',
            'name' => 'id',
            'id' => 'select',
            'selectableRows' => 0,
            'headerTemplate' => '{item}',
            'htmlOptions' => array(
                'width' => '20',
            ),
        ),
        'user_name',
        'cust_name',
        'phone',
        //array('name' => 'phone', 'value' => 'substr_replace($data->phone,"****",3,4)'),
        array('name' => 'dial_time', 'value' => 'date("Y-m-d H:i:s",$data->dial_time)'),
        //'dial_long',
        array('name' => 'dial_long', 'value' => 'gmstrftime("%H:%M:%S",$data->dial_long)'),
        array(
            'class' => 'CButtonColumn',
            'deleteButtonOptions' => array(),
            'viewButtonOptions' => array('style' => 'background-color:red'),
            'header' => '操作',
            'template' => '{play}',
            'htmlOptions' => array(
                'width' => '50',
                'style' => 'text-align:center',
            ),
            'buttons' => array(
                'play' => array(
                    'label' => '播放和下载',
                    'url' => '',
                    'imageUrl' => '',
                    'options' => array('class' => 'btn btn-info btn-minier tooltip-info', 'onclick' => 'playAndDown(this)'),
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

<script>
    function playAndDown(obj)
    {
        var trindex = $(obj).parents('tr').index();
        var dial_id = $('#select_' + trindex).val();
        var url;
<?php
$a = Yii::app()->createurl('Service/service/play3');
echo 'url=' . "'$a';";
?>
        public.dialog('播放和下载录音', url + '&id=' + dial_id);
    }
    function subCotact(timetype){
        $("#id_timetype").val(timetype); 
        $("#form1").submit();
    }
</script>  		
<script src="/static/js/secondlevel.js"></script>