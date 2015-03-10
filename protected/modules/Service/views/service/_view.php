<?php
/* @var $this ServiceController */
/* @var $data CustomerInfo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cust_no')); ?>:</b>
	<?php echo CHtml::encode($data->cust_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cust_name')); ?>:</b>
	<?php echo CHtml::encode($data->cust_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shop_name')); ?>:</b>
	<?php echo CHtml::encode($data->shop_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('corp_name')); ?>:</b>
	<?php echo CHtml::encode($data->corp_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shop_url')); ?>:</b>
	<?php echo CHtml::encode($data->shop_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shop_addr')); ?>:</b>
	<?php echo CHtml::encode($data->shop_addr); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qq')); ?>:</b>
	<?php echo CHtml::encode($data->qq); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mail')); ?>:</b>
	<?php echo CHtml::encode($data->mail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datafrom')); ?>:</b>
	<?php echo CHtml::encode($data->datafrom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cust_type')); ?>:</b>
	<?php echo CHtml::encode($data->cust_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eno')); ?>:</b>
	<?php echo CHtml::encode($data->eno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iskey')); ?>:</b>
	<?php echo CHtml::encode($data->iskey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assign_eno')); ?>:</b>
	<?php echo CHtml::encode($data->assign_eno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assign_time')); ?>:</b>
	<?php echo CHtml::encode($data->assign_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('next_time')); ?>:</b>
	<?php echo CHtml::encode($data->next_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('memo')); ?>:</b>
	<?php echo CHtml::encode($data->memo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creator')); ?>:</b>
	<?php echo CHtml::encode($data->creator); ?>
	<br />

	*/ ?>

</div>