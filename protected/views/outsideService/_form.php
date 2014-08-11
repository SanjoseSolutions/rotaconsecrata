<?php
/* @var $this OutsideServiceController */
/* @var $model OutsideServices */
/* @var $form CActiveForm */
$action = $model->isNewRecord ?
	array('/outsideService/create') : array('/outsideService/update', 'id'=>$model->id);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'outsideServices-form',
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
		<?php echo $form->labelEx($model,'institution'); ?>
		<?php echo $form->textField($model,'institution',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'institution'); ?>
	</div>

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
	<span class="left23">
		<?php echo $form->labelEx($model,'designation'); ?>
		<?php echo $form->textField($model,'designation',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'designation'); ?>
	</span>
	<span class="right13">
		<?php echo $form->labelEx($model,'duration'); ?>
		<?php echo $form->textField($model,'duration',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'duration'); ?>
	</span>
	</div>

	<?php echo $form->hiddenField($model,'member_id'); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
