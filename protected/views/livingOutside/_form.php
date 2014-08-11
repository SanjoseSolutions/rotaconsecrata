<?php
/* @var $this LivingOutsideController */
/* @var $model LivingOutside */
/* @var $form CActiveForm */
$action = $model->isNewRecord ?
	array('/livingOutside/create') : array('/livingOutside/update', 'id'=>$model->id);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'livingOutside-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'action'=>$action,
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'year_from'); ?>
		<?php echo $form->textField($model,'year_from'); ?>
		<?php echo $form->error($model,'year_from'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'year_to'); ?>
		<?php echo $form->textField($model,'year_to'); ?>
		<?php echo $form->error($model,'year_to'); ?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'institution'); ?>
		<?php echo $form->textField($model,'institution',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'institution'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'purpose'); ?>
		<?php echo $form->textField($model,'purpose',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'purpose'); ?>
	</div>

	<?php echo $form->hiddenField($model,'member_id'); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
