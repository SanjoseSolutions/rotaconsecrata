<?php
/* @var $this MembersController */
/* @var $model Members */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fullname'); ?>
		<?php echo $form->textField($model,'fullname',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo'); ?>
		<?php echo $form->textField($model,'photo',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maiden_name'); ?>
		<?php echo $form->textField($model,'maiden_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dob'); ?>
		<?php echo $form->textField($model,'dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'joining_dt'); ?>
		<?php echo $form->textField($model,'joining_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vestation_dt'); ?>
		<?php echo $form->textField($model,'vestation_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'first_commitment_dt'); ?>
		<?php echo $form->textField($model,'first_commitment_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'final_commitment_dt'); ?>
		<?php echo $form->textField($model,'final_commitment_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fathers_name'); ?>
		<?php echo $form->textField($model,'fathers_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mothers_name'); ?>
		<?php echo $form->textField($model,'mothers_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'father_alive'); ?>
		<?php echo $form->textField($model,'father_alive'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mother_alive'); ?>
		<?php echo $form->textField($model,'mother_alive'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'home_phone'); ?>
		<?php echo $form->textField($model,'home_phone',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'home_mobile'); ?>
		<?php echo $form->textField($model,'home_mobile',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parish'); ?>
		<?php echo $form->textField($model,'parish',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diocese'); ?>
		<?php echo $form->textField($model,'diocese',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'demise_dt'); ?>
		<?php echo $form->textField($model,'demise_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leaving_dt'); ?>
		<?php echo $form->textField($model,'leaving_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mission'); ?>
		<?php echo $form->textField($model,'mission'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'generalate'); ?>
		<?php echo $form->textField($model,'generalate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'community'); ?>
		<?php echo $form->textField($model,'community'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_by'); ?>
		<?php echo $form->textField($model,'updated_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_on'); ?>
		<?php echo $form->textField($model,'updated_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'swiss_visit'); ?>
		<?php echo $form->textField($model,'swiss_visit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'holyland_visit'); ?>
		<?php echo $form->textField($model,'holyland_visit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'family_abroad'); ?>
		<?php echo $form->textField($model,'family_abroad'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->