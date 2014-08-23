<?php
/* @var $this UserController */
/* @var $model Users */

$this->breadcrumbs=array(
/*	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Activate',*/
);

$this->menu=array(
);
?>

<h1>Reset Password: <?php echo $member->fullname; ?></h1>


<?php
	foreach(Yii::app()->user->getFlashes() as $key => $message) {
		echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
	}
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reset-password-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'newPassword'); ?>
		<?php echo $form->passwordField($model,'newPassword',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'newPassword'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'newPassword_repeat'); ?>
		<?php echo $form->passwordField($model,'newPassword_repeat',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'newPassword_repeat'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

