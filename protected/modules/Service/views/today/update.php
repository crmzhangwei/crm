<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/jquery-ui.min.css" /> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery-ui.min.js"></script>
<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'售后管理'=>array('list'), 
        '今日联系'=>array('list'),
	'客户详情',
);

$this->menu=array(
	 
);
Yii::app()->clientScript->registerScript('tab', " 
  
  $('#tabs').tabs({
  activate: function( event, ui ) {
        //alert(ui.newTab.attr('aria-controls'));
    }
 });  
"); 
?>  
<?php $this->renderPartial('_form', array('model'=>$model,'after'=>$after,'contract'=>$contract,'sharedNote'=>$sharedNote,'historyNote'=>$historyNote,'noteinfo'=>$noteinfo,'loginuser'=>$loginuser)); ?>

