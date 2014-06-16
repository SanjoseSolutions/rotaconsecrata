<?php
/* @var $this CommunityTermsController */
/* @var $model CommunityTerms */
/* @var $form CActiveForm */

$action = $model->isNewRecord ?
	array('/communityTerms/create') : array('/communityTerms/update', 'id'=>$model->id);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'community-terms-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'action' => $action,
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<?php
		echo $form->labelEx($model,'communityName');
		echo $form->textField($model,'communityName',array('size'=>50,'maxlength'=>50));
/*		$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => 'community',
			'source' => Communities::getAll(),
			'htmlOptions' => array('size'=>50,'maxlength'=>50)
		));*/
	?>
	</div>

	<div class="row">
	<span class="leftHalf">
	<?php
		$this_yr = date_format(new DateTime(), 'Y');
		echo $form->labelEx($model,'year_from');
		echo $form->numberField($model,'year_from',array('max'=>$this_yr,'min'=>$this_yr-100));
		echo $form->error($model,'year_from'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'year_to'); ?>
		<?php echo $form->numberField($model,'year_to',array('max'=>$this_yr,'min'=>$this_yr-100)); ?>
		<?php echo $form->error($model,'year_to'); ?>
	</span>
	</div>

	<div class="row">
	<span class="left23">
		<?php echo $form->labelEx($model,'designation'); ?>
		<?php echo $form->textField($model,'designation',array('size'=>31,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'designation'); ?>
	</span>
	<span class="right13">
		<?php echo $form->labelEx($model,'duration'); ?>
		<?php echo $form->textField($model,'duration',array('size'=>12,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'duration'); ?>
	</span>
	</div>

	<?php echo $form->hiddenField($model,'member_id'); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
