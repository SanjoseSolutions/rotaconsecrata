<?php
$action = $model->isNewRecord ? array('/renewals/create') : array('/renewals/update', 'id'=>$model->id);

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'renewals-form',
	'action' => $action,
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<span class="renewal-field">
		<?php echo $form->labelEx($model,'renewal_dt'); ?>
		<?php echo $form->textField($model,'renewal_dt'); ?>
		<?php echo $form->error($model,'renewal_dt'); ?>
	</span>

	<span class="renewal-field">
	<?php
		echo $form->labelEx($model,'place');
		echo $form->textField($model,'place',array('size'=>35,'maxlength'=>75));
		echo $form->error($model,'place');
		echo $form->hiddenField($model, 'member_id');
		if (!$model->isNewRecord) {
			echo $form->hiddenField($model, 'id', array('value'=>$model->id));
		}
	?>
	</span>

	<span class="renewal-field">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</span>

<?php $this->endWidget(); ?>

