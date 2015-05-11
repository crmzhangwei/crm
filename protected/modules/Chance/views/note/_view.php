<?php
/* @var $this NoteController */
/* @var $data NoteInfo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cust_id')); ?>:</b>
	<?php echo CHtml::encode($data->cust_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cust_info')); ?>:</b>
	<?php echo CHtml::encode($data->cust_info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requirement')); ?>:</b>
	<?php echo CHtml::encode($data->requirement); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('service')); ?>:</b>
	<?php echo CHtml::encode($data->service); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dissent')); ?>:</b>
	<?php echo CHtml::encode($data->dissent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('next_followup')); ?>:</b>
	<?php echo CHtml::encode($data->next_followup); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('memo')); ?>:</b>
	<?php echo CHtml::encode($data->memo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isvalid')); ?>:</b>
	<?php echo CHtml::encode($data->isvalid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iskey')); ?>:</b>
	<?php echo CHtml::encode($data->iskey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('next_contact')); ?>:</b>
	<?php echo CHtml::encode($data->next_contact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dial_id')); ?>:</b>
	<?php echo CHtml::encode($data->dial_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eno')); ?>:</b>
	<?php echo CHtml::encode($data->eno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	*/ ?>

</div>