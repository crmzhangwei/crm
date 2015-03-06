<?php
/* @var $this FinanceController */
/* @var $data Finance */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cust_id')); ?>:</b>
	<?php echo CHtml::encode($data->cust_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_user')); ?>:</b>
	<?php echo CHtml::encode($data->sale_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trans_user')); ?>:</b>
	<?php echo CHtml::encode($data->trans_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('acct_number')); ?>:</b>
	<?php echo CHtml::encode($data->acct_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('acct_amount')); ?>:</b>
	<?php echo CHtml::encode($data->acct_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('acct_time')); ?>:</b>
	<?php echo CHtml::encode($data->acct_time); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('creator')); ?>:</b>
	<?php echo CHtml::encode($data->creator); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	*/ ?>

</div>