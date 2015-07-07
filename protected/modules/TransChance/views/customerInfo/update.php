<?php
/* @var $this CustomerInfoController */
/* @var $model CustomerInfo */

$this->breadcrumbs=array(
	'成交师-机会管理'=>array('admin'),
	'客户详情',
);
Yii::app()->clientScript->registerScript('tab', " 
  
  $('#tabs').tabs({
  activate: function( event, ui ) {
        //alert(ui.newTab.attr('aria-controls'));
    }
 });  
"); 
?>
<?php $this->renderPartial('_form', array('model'=>$model,'trans_model'=>$trans_model,'user'=>$user,'noteinfo'=>$noteinfo,'historyNote' =>$historyNote,'sharedNote' => $sharedNote,'contract'=>$contract)); ?>