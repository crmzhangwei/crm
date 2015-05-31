
<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'售后管理'=>array('list'),
        '新分客户'=>array('list'),
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
<?php $this->renderPartial('_form', array('model'=>$model,'sharedNote'=>$sharedNote,'historyNote'=>$historyNote,'noteinfo'=>$noteinfo,'loginuser'=>$loginuser)); ?>

