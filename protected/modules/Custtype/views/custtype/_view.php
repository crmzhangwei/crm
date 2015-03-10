<?php
/* @var $this CusttypeController */
/* @var $data CustType */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lib_type')); ?>:</b>
	<?php echo CHtml::encode($data->lib_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_no')); ?>:</b>
	<?php echo CHtml::encode($data->type_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_name')); ?>:</b>
	<?php echo CHtml::encode($data->type_name); ?>
	<br />


</div>