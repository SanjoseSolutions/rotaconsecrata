<?php
$action = $model->isNewRecord ? array('/academicCourses/create') : array('/academicCourses/update', 'id'=>$model->id);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'academicCourses-form',
	'action' => $action,
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<span class="sib-field">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</span>

	<span class="sib-field">
		<?php echo $form->labelEx($model,'institution'); ?>
		<?php echo $form->textField($model,'institution',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'institution'); ?>
	</span>

	<span class="sib-field">
		<?php echo $form->labelEx($model,'board'); ?>
		<?php echo $form->textField($model,'board',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'board'); ?>
	</span>

	<span class="sib-field">
		<?php echo $form->labelEx($model,'class'); ?>
		<?php echo $form->textField($model,'class',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'class'); ?>
	</span>

	<span class="sib-field">
		<?php echo $form->labelEx($model,'certificate_dt'); ?>
		<?php echo $form->textField($model,'certificate_dt',array('placeholder'=>'yyyy-mm-dd')); ?>
		<?php echo $form->error($model,'certificate_dt'); ?>
	</span>

	<span class="sib-field">
		<?php echo $form->labelEx($model,'subjects'); ?>
		<?php echo $form->textField($model,'subjects',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'subjects'); ?>
	</span>

	<span class="sib-field">
		<?php echo $form->labelEx($model,'medium'); ?>
		<?php echo $form->textField($model,'medium',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'medium'); ?>
	</span>

	<span class="sib-field">
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textField($model,'remarks',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'remarks'); ?>
	</span>

	<span>
	<?php
		echo $form->hiddenField($model, 'member_id');
		if (!$model->isNewRecord) {
			echo $form->hiddenField($model, 'id', array('value'=>$model->id));
		}
		echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');
	?>
	</span>

<?php $this->endWidget(); ?>

</div><!-- form -->
