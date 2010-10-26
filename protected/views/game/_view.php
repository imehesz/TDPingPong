<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('players_home')); ?>:</b>
	<?php echo CHtml::encode($data->players_home); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('players_visitor')); ?>:</b>
	<?php echo CHtml::encode($data->players_visitor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('score_home')); ?>:</b>
	<?php echo CHtml::encode($data->score_home); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('score_visitor')); ?>:</b>
	<?php echo CHtml::encode($data->score_visitor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('details')); ?>:</b>
	<?php echo CHtml::encode($data->details); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	*/ ?>

</div>