<?php
/* @var $this TravelsController */
/* @var $model Travels */
/* @var $form CActiveForm */

$action = $model->isNewRecord ? array('/travels/create') : array('/travels/update', 'id'=>$model->id);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'travels-form',
	'action'=>$action,
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<span class="sib-field">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->textField($model,'year', array('size'=>10)); ?>
		<?php echo $form->error($model,'year'); ?>
	</span>

	<span class="sib-field">
		<?php echo $form->labelEx($model,'places'); ?>
		<?php echo $form->textField($model,'places',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'places'); ?>
	</span>

	<span class="sib-field">
		<?php echo $form->labelEx($model,'nature'); ?>
		<?php echo $form->textField($model,'nature',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nature'); ?>
	</span>

	<span><?php
		echo $form->hiddenField($model, 'member_id');
		if (!$model->isNewRecord) {
			echo $form->hiddenField($model, 'id', array('value'=>$model->id));
		}
		echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</span>

<?php $this->endWidget(); ?>

</div><!-- form -->
