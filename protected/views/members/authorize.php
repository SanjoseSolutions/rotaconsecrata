<?php
/* @var $this UserController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<h1>Authorize User #<?php echo $model->id . ': '.$model->fullname ?></h1>

<div class='msg'><p>
<?php
	$this->widget('application.extensions.email.Debug');
	$msg = Yii::app()->user->getFlash('msg');
	if (!empty($msg)) {
		echo $msg;
	} else {
		echo "Grant user access to application";
	}
?>
</p></div>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model);
	?>

	<div class="row">
	<?php
		echo CHtml::label('Role', 'role');
		echo CHtml::dropDownList('role', '', array(
			'' => 'Member',
			'Admin' => 'Generalate Admin',
			'ProvAdm' => 'Provincial Admin',
		));
	?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
