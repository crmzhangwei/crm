<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'错误',
);
?>

<h2>错误码: <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>