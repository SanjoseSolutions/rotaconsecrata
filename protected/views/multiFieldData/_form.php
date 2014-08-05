<?php
/* @var $this MultiFieldDataController */
/* @var $model MultiFieldData */
/* @var $form CActiveForm */
$action = $model->isNewRecord ? array('/multiFieldData/create') : array('/multiFieldData/update', 'id'=>$model->id);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>$fieldName.'-form',
	'action'=>$action,
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<span class="sib-field">
		<?php echo $form->labelEx($model,'descr'); ?>
		<?php echo $form->textField($model,'descr',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'descr'); ?>
	</span>


	<span>
	<?php
		echo $form->hiddenField($model, 'member_id');
		echo $form->hiddenField($model, 'field_id');
		if (!$model->isNewRecord) {
			echo $form->hiddenField($model, 'id', array('value'=>$model->id));
		}
		echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');
	?>
	</span>

<?php $this->endWidget(); ?>

</div><!-- form -->
