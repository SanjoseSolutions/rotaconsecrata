<?php
/* @var $this MembersController */
/* @var $data Members */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fullname')); ?>:</b>
	<?php echo CHtml::encode($data->fullname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo')); ?>:</b>
	<?php echo CHtml::encode($data->photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maiden_name')); ?>:</b>
	<?php echo CHtml::encode($data->maiden_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($data->mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dob')); ?>:</b>
	<?php echo CHtml::encode($data->dob); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('joining_dt')); ?>:</b>
	<?php echo CHtml::encode($data->joining_dt); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('vestation_dt')); ?>:</b>
	<?php echo CHtml::encode($data->vestation_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_commitment_dt')); ?>:</b>
	<?php echo CHtml::encode($data->first_commitment_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('final_commitment_dt')); ?>:</b>
	<?php echo CHtml::encode($data->final_commitment_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fathers_name')); ?>:</b>
	<?php echo CHtml::encode($data->fathers_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mothers_name')); ?>:</b>
	<?php echo CHtml::encode($data->mothers_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('father_alive')); ?>:</b>
	<?php echo CHtml::encode($data->father_alive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mother_alive')); ?>:</b>
	<?php echo CHtml::encode($data->mother_alive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_phone')); ?>:</b>
	<?php echo CHtml::encode($data->home_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_mobile')); ?>:</b>
	<?php echo CHtml::encode($data->home_mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parish')); ?>:</b>
	<?php echo CHtml::encode($data->parish); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diocese')); ?>:</b>
	<?php echo CHtml::encode($data->diocese); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('demise_dt')); ?>:</b>
	<?php echo CHtml::encode($data->demise_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leaving_dt')); ?>:</b>
	<?php echo CHtml::encode($data->leaving_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mission')); ?>:</b>
	<?php echo CHtml::encode($data->mission); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('generalate')); ?>:</b>
	<?php echo CHtml::encode($data->generalate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('community')); ?>:</b>
	<?php echo CHtml::encode($data->community); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_by')); ?>:</b>
	<?php echo CHtml::encode($data->updated_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_on')); ?>:</b>
	<?php echo CHtml::encode($data->updated_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('swiss_visit')); ?>:</b>
	<?php echo CHtml::encode($data->swiss_visit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('holyland_visit')); ?>:</b>
	<?php echo CHtml::encode($data->holyland_visit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('family_abroad')); ?>:</b>
	<?php echo CHtml::encode($data->family_abroad); ?>
	<br />

	*/ ?>

</div>