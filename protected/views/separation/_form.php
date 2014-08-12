<?php
/* @var $this SeparationController */
/* @var $model Separations */
/* @var $form CActiveForm */

$action = $model->isNewRecord ?
	array('/separation/create') : array('/separation/update', 'id'=>$model->id);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'separations-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'action' => $action,
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<span class="leftHalf">
	<?php
		$this_yr = date_format(new DateTime(), 'Y');
		echo $form->labelEx($model,'year_from');
		echo $form->numberField($model,'year_from',array('max'=>$this_yr,'min'=>$this_yr-100));
		echo $form->error($model,'year_from'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'year_to'); ?>
		<?php echo $form->numberField($model,'year_to',array('max'=>$this_yr,'min'=>$this_yr-100)); ?>
		<?php echo $form->error($model,'year_to'); ?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nature'); ?>
		<?php echo $form->textField($model,'nature',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nature'); ?>
	</div>

	<div class="row buttons">
		<?php echo $form->hiddenField($model,'member_id'); ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
