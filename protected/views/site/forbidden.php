<?php

/** 
 *  forbidden.php 403禁止访问的页面
 *  ============================================================================
 *  Copyright (c) 2014 TO8TO Ltd.
 *  Web: http://www.to8to.com
 *  License: http://www.to8to.com/license.txt
 *  ============================================================================
 *  $Author: gavin.li $
 *  $Id: forbidden.php 83643 2015-01-20 05:50:48Z gavin.li $
 */


$this->pageTitle= '禁止访问 - ' . Yii::app()->name;
$this->breadcrumbs=array(
	'出错了',
);
?>

<div class="error-container">
    <div class="well">
        <h1 class="grey lighter smaller">
            <span class="blue bigger-125">
                <i class="icon-random"></i>
                <?php echo $code; ?>
            </span>
            Forbidden
        </h1>

        <hr>
        <h3 class="lighter bigger">
            <?php echo CHtml::encode($message); ?>
        </h3>

        <hr>
        <div class="space"></div>

        <div class="center">
            <a href="javascript: window.history.back()" class="btn btn-grey">
                <i class="icon-arrow-left"></i>
                返回
            </a>

            <a href="<?php echo $this->createUrl($this->defaultAction)?>" class="btn btn-primary">
                <i class="icon-dashboard"></i>
                首页
            </a>
        </div>
    </div>
</div>