<?php
/* @var $this Card3Controller */
/* @var $data Card3 */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('seq')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->seq), array('view', 'id'=>$data->seq)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip')); ?>:</b>
	<?php echo CHtml::encode($data->ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prop_time')); ?>:</b>
	<?php echo CHtml::encode($data->prop_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drink_time')); ?>:</b>
	<?php echo CHtml::encode($data->drink_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drink_operator_id')); ?>:</b>
	<?php echo CHtml::encode($data->drink_operator_id); ?>
	<br />


</div>