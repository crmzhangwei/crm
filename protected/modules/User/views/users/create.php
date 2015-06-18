<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'用户管理'=>array(''),
	'创建用户',
);
 $this->renderPartial('_form', array('model'=>$model,'deptArr'=>$deptArr,'user_info'=>$user_info));