<?php
/* @var $this RenewalCoursesSpiritualController */
/* @var $model RenewalCoursesSpiritual */
/* @var $form CActiveForm */
?>

<?php
$action = $model->isNewRecord ?
	array('/renewalCoursesSpiritual/create') :
	array('/renewalCoursesSpiritual/update', 'id'=>$model->id);
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'spiritualRenewalCourses-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'action'=>$action,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<span class="fields">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</span>

	<span class="fields">
	<?php
		$yr = date_format(new DateTime(), 'Y');
		echo $form->labelEx($model,'year');
		echo $form->numberField($model,'year',array(
			'min' => ($yr-100),
			'max' => $yr,
			'value'=>$yr
		));
		echo $form->error($model,'year');
	?>
	</span>

	<?php echo $form->hiddenField($model,'member_id'); ?>

	<span class="fields buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</span>

<?php $this->endWidget(); ?>
