<?php
/* @var $this CustomerInfoController */
/* @var $model CustomerInfo */
$this->pageTitle = '我的联系机会';
$this->breadcrumbs = array(
    '机会管理' => array('admin'),
    '我的联系机会',
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

<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>
<div class="form-group">
           
    <?php echo $form->label($model, 'contact_7_day'); ?>
    <?php echo $form->dropDownList($model, 'contact_7_day', array('--请选择--', '是'), array('style' => "height:34px;")); ?>
    <?php echo $form->label($model, 'iskey'); ?>
    <?php echo $form->dropDownList($model, 'iskey', array('-1'=>'--请选择--','1'=> '是','0'=> '否'), array('style' => "height:34px;")); ?>
    <?php echo $form->label($model, 'phone'); ?>
    <?php echo $form->textField($model, 'phone', array('size' => 12, 'maxlength' => 12)); ?>
     <?php echo $form->label($model, 'qq'); ?>
    <?php echo $form->textField($model, 'qq', array('size' => 12, 'maxlength' => 12)); ?>
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
	
    <?php echo $form->label($model, 'cust_type'); ?>
    <?php echo $form->dropDownList($model, 'cust_type_from',$this->genCustTypeArray(), array('style' => "height:32px;")); ?>至
    <?php echo $form->dropDownList($model, 'cust_type_to', $this->genCustTypeArray(), array('style' => "height:32px;")); ?>
    <button class="btn btn-sm btn-primary" type="submit">
        <i class="icon-search"></i>
        搜 索
    </button>
</div>

<?php $this->endWidget(); ?>
<font color="red"><?php echo Yii::app()->user->getFlash('success');Yii::app()->user->setFlash('success','') ?></font>
<?php
$form1 = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl('Chance/customerInfo/clearcondiForMyList'),
    'method' => 'post',
    'id' =>'form_1'
        ));
?>
<div class="form-group">
    <div class="btn-group"> 
        <?php echo CHtml::button('合并客户', array('class' => 'btn btn-sm btn-primary','onclick'=>'subMerge();')); ?>
        <?php echo CHtml::button('批量放入公海', array('class' => 'btn btn-sm btn-primary','onclick'=>'subBatchBlack();')); ?>
        <?php echo CHtml::submitButton('清除查询条件', array('class' => 'btn btn-sm btn-primary')); ?>
    </div>  
</div>

<?php
$dataProvider=$model->searchMyList();
$this->widget('GGridView', array(
    'id' => 'customer-info-grid',
    'dataProvider' =>$dataProvider ,
    'rowCssClassExpression' => '
        ( $row%2 ? $this->rowCssClass[1] : $this->rowCssClass[0] ) .
        ( $data->iskey ?  " red":null  )
    ',
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
        'id',
        array('name'=>'eno', 'value'=>array($this, 'get_eno_text')),
        array('name'=>'cust_type', 'value'=>array($this, 'get_sale_type_text')),
        'cust_name',
        'shop_name',
        'corp_name',
        array(
            'name'=>'category',
            'value'=>array($this,'getCartTxt'),
        ),
        array(
          'name'=>'assign_time',
          'type'=>'raw',
          'value'=>array($this,'get_assign_time'),
        ),
        array(
          'name'=>'next_time',
          'header'=>'安排联系时间',
          'type'=>'raw',
          'value'=>array($this,'get_next_time'),
        ),
        array(
          'name'=>'update_time',
          'type'=>'raw',
          'value'=>'date("Y-m-d H:i:s",$data->update_time)',
        ),
        array(
          'name'=>'last_time',
          'type'=>'raw',
          'value'=>array($this,'get_last_time'),
        ),
        array(
          'name'=>'assign_eno',
          'type'=>'raw',
          'value'=>array($this,'get_assign_eno_text'),
        ),
        /*
          'shop_addr',
          'phone',
          'qq',
          'mail',
          'datafrom',
          'category',
          'cust_type',
          'iskey',
          'assign_eno',
          'memo',
          'create_time',
          'creator',
         */
              array(
            'class' => 'CButtonColumn',
            'template' => '{upda}', 
            'buttons' => array(
                'upda' => array(
                    'label' => '查看客户详情',
                    'url' => 'Yii::app()->controller->createUrl("edit",array("id"=>$data->primaryKey,"module"=>"todayList"))',
                    'imageUrl' => '',
                    'options' => array('class' => 'editNode btn btn-info btn-minier tooltip-info', 'data-placement' => "bottom"),
                ),
            ),
        ),
    ),
));
?>
<?php $this->endWidget(); ?>
<div class="table-page"> 
    <div class="col-sm-6">
        共<span class="orange"><?= $dataProvider->totalItemCount ?></span>条记录 
    </div>
    <div class="col-sm-6 no-padding-right">
<?php
$this->widget('GLinkPager', array('pages' => $dataProvider->getPagination(),));
?>
    </div>
</div>

<script src="/static/js/secondlevel.js"></script>
<script> 
    function clearCondi(){
         var url = "<?php echo Yii::app()->controller->createUrl('customerInfo/clearcondiForMyList');?>";
         $("#form_1").attr('action',url);
         $("#form_1").submit();
    }
	$(function(){
        $(".button-column").find("a").attr("target","_blank");
    });
    function subMerge(){
         var url = "<?php echo Yii::app()->controller->createUrl('customerInfo/merge');?>";
         $("#form_1").attr('action',url);
         $("#form_1").submit();
    }
    function subBatchBlack(){
        if(confirm('确定将选中客户放放公海')){
            var url = "<?php echo Yii::app()->controller->createUrl('customerInfo/batchBlack');?>";
            $("#form_1").attr('action',url);
            $("#form_1").submit();
        } 
    }
</script>