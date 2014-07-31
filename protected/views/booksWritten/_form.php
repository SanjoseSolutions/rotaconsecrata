<?php
/* @var $this BooksWrittenController */
/* @var $model BooksWritten */
/* @var $form CActiveForm */
$action = $model->isNewRecord ? array('/booksWritten/create') : array('/booksWritten/update', 'id'=>$model->id);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'books-written-form',
	'action'=>$action,
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'authors'); ?>
		<?php echo $form->textField($model,'authors',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'authors'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->textField($model,'year'); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'publisher'); ?>
		<?php echo $form->textField($model,'publisher',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'publisher'); ?>
	</div>

	<div class="row buttons"><?php
		echo $form->hiddenField($model, 'member_id');
		if (!$model->isNewRecord) {
			echo $form->hiddenField($model, 'id', array('value'=>$model->id));
		}
		echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
