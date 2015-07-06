<?php
/* @var $this CustomerInfoController */
/* @var $model CustomerInfo */
$this->pageTitle = '我的联系机会';
$this->breadcrumbs = array(
    '机会管理' => array('admin'),
    '安排联系机会',
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
    <?php echo $form->dropDownList($model, 'iskey', array('--请选择--', '是', '否'), array('style' => "height:34px;")); ?>
    <?php echo $form->label($model, 'phone'); ?>
    <?php echo $form->textField($model, 'phone', array('size' => 15, 'maxlength' => 15)); ?><br />
    <?php echo $form->label($model, 'cust_type'); ?>
    <?php echo $form->dropDownList($model, 'cust_type_from',$this->genCustTypeArray(), array('style' => "height:34px;")); ?>至
    <?php echo $form->dropDownList($model, 'cust_type_to', $this->genCustTypeArray(), array('style' => "height:34px;")); ?>
    安排联系时间:
    <?php echo $form->textField($model,'next_time',array('class'=>"Wdate", 'onClick'=>"WdatePicker()",'style'=>'height:30px;')); ?>
    <button class="btn btn-sm btn-primary" type="submit">
        <i class="icon-search"></i>
        搜 索
    </button>
</div>

<?php $this->endWidget(); ?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl('TransChance/customerinfo/assignNextTime'),
    'method' => 'post',
        ));
?>
<div class="form-group">
    <div class="btn-group">
<?php echo CHtml::submitButton('批量安排联系时间', array('class' => 'btn btn-sm btn-primary')); ?>
    </div>  
</div>
<?php
$dataProvider = $model->search();
$this->widget('GGridView', array(
    'id' => 'customer-info-grid',
    'dataProvider' => $dataProvider,
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
        array('name'=>'cust_type', 'value'=>array($this, 'get_trans_type_text')),
        'cust_name',
        'shop_name',
        'corp_name',
        array(
            'name'=>'category',
            'value'=>array($this,'getCartTxt'),
        ),
        array(
          'header'=>'分配时间',
          'name'=>'assign_time',
          'type'=>'raw',
          'value'=>'date("Y-m-d",$data->assign_time)',
        ),
        array(
          'name'=>'next_time',
          'header'=>'安排联系时间',
          'type'=>'raw',
          'value'=>'date("Y-m-d",$data->next_time)',
        ),
        array(
          'name'=>'last_time',
          'type'=>'raw',
          'value'=>'date("Y-m-d",$data->last_time)',
        ),
        'shop_addr',
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
                    'url' => 'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
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