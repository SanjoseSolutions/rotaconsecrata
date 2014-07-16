<?php
/* @var $this MembersController */
/* @var $model Members */
/* @var $form CActiveForm */

$yesno_opts = array(1 => 'Yes', 0 => 'No');

?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fullname'); ?>
		<?php echo $form->textField($model,'fullname',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maiden_name'); ?>
		<?php echo $form->textField($model,'maiden_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->label($model,'dob'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'dob',
			'options'       => array(
				'dateFormat' => FormatHelper::getDatePickerFormat(),
				'yearRange'  => '1900:c+10',
				'maxDate'    => 0,
				'changeYear' => true,
			),
			'htmlOptions'	=> array(
				'placeholder' => 'dd/mm/yyyy',
				'size' => 10,
				'maxlength' => 10,
			),
		)); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->label($model,'age'); ?>
		<?php echo $form->textField($model,'age'); ?>
	</span>
	</div>

	<div>
	<span class="leftHalf">
		<?php echo $form->label($model,'bday_from'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'bday_from',
			'options'       => array(
				'dateFormat' => FormatHelper::getDatePickerFormat(),
				'yearRange'  => '1900:c+10',
				'maxDate'    => 0,
				'changeYear' => true,
			),
			'htmlOptions'	=> array(
				'placeholder' => 'dd/mm/yyyy',
				'size' => 10,
				'maxlength' => 10,
			),
		)); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->label($model,'bday_to'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'bday_to',
			'options'       => array(
				'dateFormat' => FormatHelper::getDatePickerFormat(),
				'yearRange'  => '1900:c+10',
				'maxDate'    => 0,
				'changeYear' => true,
			),
			'htmlOptions'	=> array(
				'placeholder' => 'dd/mm/yyyy',
				'size' => 10,
				'maxlength' => 10,
			),
		)); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->label($model,'joining_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'joining_dt',
			'options'       => array(
				'dateFormat' => FormatHelper::getDatePickerFormat(),
				'yearRange'  => '1900:c+10',
				'maxDate'    => 0,
				'changeYear' => true,
			),
			'htmlOptions'	=> array(
				'placeholder' => 'dd/mm/yyyy',
				'size' => 10,
				'maxlength' => 10,
			),
		)); ?>
	</span>
	<span class="rightHalf">
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->label($model,'vestition_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'vestition_dt',
			'options'       => array(
				'dateFormat' => FormatHelper::getDatePickerFormat(),
				'yearRange'  => '1900:c+10',
				'maxDate'    => 0,
				'changeYear' => true,
			),
			'htmlOptions'	=> array(
				'placeholder' => 'dd/mm/yyyy',
				'size' => 10,
				'maxlength' => 10,
			),
		)); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->label($model,'first_commitment_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'first_commitment_dt',
			'options'       => array(
				'dateFormat' => FormatHelper::getDatePickerFormat(),
				'yearRange'  => '1900:c+10',
				'maxDate'    => 0,
				'changeYear' => true,
			),
			'htmlOptions'	=> array(
				'placeholder' => 'dd/mm/yyyy',
				'size' => 10,
				'maxlength' => 10,
			),
		)); ?>
	</span>
	<span class="rightHalf">
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->label($model,'final_commitment_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'final_commitment_dt',
			'options'       => array(
				'dateFormat' => FormatHelper::getDatePickerFormat(),
				'yearRange'  => '1900:c+10',
				'maxDate'    => 0,
				'changeYear' => true,
			),
			'htmlOptions'	=> array(
				'placeholder' => 'dd/mm/yyyy',
				'size' => 10,
				'maxlength' => 10,
			),
		)); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->label($model,'made_final'); ?>
		<?php echo $form->dropDownList($model, 'made_final', $yesno_opts, array('prompt' => '-- Select --')); ?>
	</span>
	</div>

	<div>
		<?php echo $form->label($model,'specialization'); ?>
		<?php echo $form->dropDownList($model, 'specialization', Specializations::getAll(), array(
			'prompt'=>'-- Select one --')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fathers_name'); ?>
		<?php echo $form->textField($model,'fathers_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mothers_name'); ?>
		<?php echo $form->textField($model,'mothers_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->label($model,'father_alive'); ?>
		<?php echo $form->dropDownList($model,'father_alive',$yesno_opts, array('prompt' => '-- Select --')); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->label($model,'mother_alive'); ?>
		<?php echo $form->dropDownList($model,'mother_alive',$yesno_opts, array('prompt' => '-- Select --')); ?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'home_phone'); ?>
		<?php echo $form->textField($model,'home_phone',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'home_mobile'); ?>
		<?php echo $form->textField($model,'home_mobile',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parish'); ?>
		<?php echo $form->textField($model,'parish',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diocese'); ?>
		<?php echo $form->textField($model,'diocese',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'demise_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'demise_dt',
			'options'       => array(
				'dateFormat' => FormatHelper::getDatePickerFormat(),
				'yearRange'  => '1900:c+10',
				'maxDate'    => 0,
				'changeYear' => true,
			),
			'htmlOptions'	=> array(
				'placeholder' => 'dd/mm/yyyy',
				'size' => 10,
				'maxlength' => 10,
			),
		)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leaving_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'leaving_dt',
			'options'       => array(
				'dateFormat' => FormatHelper::getDatePickerFormat(),
				'yearRange'  => '1900:c+10',
				'maxDate'    => 0,
				'changeYear' => true,
			),
			'htmlOptions'	=> array(
				'placeholder' => 'dd/mm/yyyy',
				'size' => 10,
				'maxlength' => 10,
			),
		)); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->label($model,'community'); ?>
		<?php echo $form->dropDownList($model,'community', Communities::getAllHash(), array('prompt' => '-- Select one --')); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->label($model,'current_community'); ?>
		<?php echo $form->dropDownList($model,'current_community', Communities::getAllHash(), array('prompt' => '-- Select one --')); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->label($model,'current_designation'); ?>
		<?php echo $form->textField($model,'current_designation'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->label($model,'updated_on'); ?>
		<?php echo $form->textField($model,'updated_on'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->label($model,'mission'); ?>
		<?php echo $form->dropDownList($model,'mission', $yesno_opts, array('prompt' => '-- Select --')); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->label($model,'generalate'); ?>
		<?php echo $form->dropDownList($model,'generalate', $yesno_opts, array('prompt' => '-- Select --')); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->label($model,'holyland_visit'); ?>
		<?php echo $form->dropDownList($model,'holyland_visit', $yesno_opts, array('prompt' => '-- Select --')); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->label($model,'family_abroad'); ?>
		<?php echo $form->dropDownList($model,'family_abroad', $yesno_opts, array('prompt' => '-- Select --')); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->label($model,'swiss_visit'); ?>
		<?php echo $form->dropDownList($model,'swiss_visit', $yesno_opts, array('prompt' => '-- Select --')); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->label($model,'annual_checkups'); ?>
		<?php echo $form->dropDownList($model,'annual_checkups', $yesno_opts, array('prompt' => '-- Select --')); ?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search', array('id' => 'submit-button')); ?>
		<?php echo CHtml::submitButton('Excel Export', array('name' => 'export')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
