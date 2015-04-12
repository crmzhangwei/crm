<?php
/* @var $this CustomerInfoController */
/* @var $model CustomerInfo */

$this->breadcrumbs = array(
    'Customer Infos' => array('index'),
    'Manage',
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
    <div class="btn-group">
        <a href="javascript:void(0)" onclick="javascript:openwinx('<?= Yii::app()->createUrl('CustomerInfo/create') ?>', '')" class="btn btn-sm btn-primary" > 
            <i class="icon-plus"></i>新建用户
        </a>
    </div>        
    <?php echo $form->label($model, 'contact_7_day'); ?>
    <?php echo $form->dropDownList($model, 'contact_7_day', array('全部', '是'), array('style' => "height:34px;")); ?>
    <?php echo $form->label($model, 'iskey'); ?>
    <?php echo $form->dropDownList($model, 'iskey', array('全部', '是', '否'), array('style' => "height:34px;")); ?>
    <?php echo $form->label($model, 'phone'); ?>
    <?php echo $form->textField($model, 'phone', array('size' => 15, 'maxlength' => 15)); ?>
    <?php echo $form->label($model, 'cust_type'); ?>
    <?php echo $form->dropDownList($model, 'cust_type_from',$this->genCustTypeArray(), array('style' => "height:34px;")); ?>至
    <?php echo $form->dropDownList($model, 'cust_type_to', $this->genCustTypeArray(), array('style' => "height:34px;")); ?>
    <button class="btn btn-sm btn-primary" type="submit">
        <i class="icon-search"></i>
        搜 索
    </button>
</div>

<?php $this->endWidget(); ?>
<?php
$this->widget('GGridView', array(
    'id' => 'customer-info-grid',
    'dataProvider' => $model->search(),
//  'filter'=>$model,
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
        'eno',
        'cust_name',
        'shop_name',
        'corp_name',
        'category',
        array(
          'header'=>'分配时间',
          'type'=>'raw',
          'value'=>'date("Y-m-d :H:i:s",$data->assign_time)',
        ),
        array(
          'header'=>'安排联系时间',
          'type'=>'raw',
          'value'=>'date("Y-m-d :H:i:s",$data->next_time)',
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
            'htmlOptions' => array(
                'width' => '100',
                'style' => 'text-align:center',
            ),
        ),
    ),
));
?>
