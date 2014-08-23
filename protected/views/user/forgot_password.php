<?php
/* @var $this UserController */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'forgot-userpass-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<h1>Forgot Password</h1>

<p>Kindly use this form to request for password reset. Link will be sent to your registered email.</p>

<?php
	foreach(Yii::app()->user->getFlashes() as $key => $message) {
		echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
	}
	$this->widget('application.extensions.email.Debug');
?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
	<?php
		echo CHtml::label('Email', 'email');
		echo CHtml::textField('email', '', array('id'=>'email'));
	?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Request Password Reset'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
