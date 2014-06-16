<h1>Photo: <?php echo $model->fullname ?></h1>

<fieldset class="photo">
<legend>Upload from System</legend>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'photo-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<div class="row">
	<?php if (true) { #Yii::app()->params['photoManip']) {
				$field = 'raw_photo';
		} else {
				$field = 'photo';
		}
		echo CHtml::label('Select', "Members_$field");
		echo $form->fileField($model, $field, array('accept' => 'image/*'));
	?>
	</div>

	<div class="row buttons">
			<?php echo CHtml::submitButton('Upload'); ?>
	</div>

<?php $this->endWidget(); ?>

</fieldset>
