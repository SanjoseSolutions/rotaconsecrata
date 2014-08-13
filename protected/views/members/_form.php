<?php
/* @var $this MembersController */
/* @var $model Members */
/* @var $form CActiveForm */

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'members-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<span class="left34">
	<?php
		echo $form->labelEx($model, 'member_no');
		echo $form->textField($model, 'member_no', array('size'=>32, 'maxlength'=>32, 'placeholder'=>'Member admission no'));
	?>
	</span>
	<span class="right14">
	<?php 
		$u = Yii::app()->user;
		if ($u->checkAccess('Admin')) {
			echo $form->labelEx($model, 'province_id');
			echo $form->dropDownList($model, 'province_id', Provinces::getAll(), array('prompt' => '-- Select --'));
		} else {
			echo $form->hiddenField($model, 'province_id', array('value' => $u->profile->member->province_id));
		}
	?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fullname'); ?>
		<?php echo $form->textField($model,'fullname',array('size'=>80,'maxlength'=>100,'placeholder'=>'Enter Sister Fullname')); ?>
		<?php echo $form->error($model,'fullname'); ?>
	</div>

	<?php if (!$model->isNewRecord): ?>
	<figure class="photo">
	<?php if (!$model->photo) {
			$photo_path = "/images/placeholder-woman.jpg";
			$src = Yii::app()->request->baseUrl . $photo_path;
			list($width, $height) = getimagesize(".$photo_path");
			$label = 'Add Photo';
		} else {
			$src = Yii::app()->request->baseUrl . '/images/members/' . $model->photo;
			list($width, $height) = getimagesize("./images/members/" . $model->photo);
			$label = 'Update Photo';
		}
		$alt = 'Member photo';
		echo CHtml::image($src, $alt, array('width' => $width, 'height' => $height));
		echo "<figcaption>";
		echo CHtml::link($label, array('photo', 'id'=>$model->id));
		echo "</figcaption>";
	?>
	</figure>
	
	<div class="rightSection">
	<?php endif ?>

	<div class="row">
		<?php echo $form->labelEx($model,'maiden_name'); ?>
		<?php echo $form->textField($model,'maiden_name',array('size'=>34,'maxlength'=>100,'placeholder'=>'Enter Maiden Name')); ?>
		<?php echo $form->error($model,'maiden_name'); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->telField($model,'mobile',array('size'=>15,'maxlength'=>15,'placeholder'=>'Enter Mobile, if any')); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->emailField($model,'email',array('placeholder'=>'Enter Email, if any')); ?>
		<?php echo $form->error($model,'email'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'dob'); ?>
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
		<?php echo $form->error($model,'dob'); ?>
	</span>
	<span class="rightHalf">
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'birth_state'); ?>
		<?php echo $form->textField($model,'birth_state',array(
			'placeholder'=>'Enter '.$model->getAttributeLabel('birth_state'),
			'size'=>25,
			'maxlength'=>50
		)); ?>
		<?php echo $form->error($model,'birth_state'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'birth_district'); ?>
		<?php echo $form->textField($model,'birth_district',array(
			'placeholder'=>'Enter '.$model->getAttributeLabel('birth_district'),
			'size'=>25,
			'maxlength'=>50
		)); ?>
		<?php echo $form->error($model,'birth_district'); ?>
	</span>
	</div>

	<div class="row">
	<span class="left13">
		<?php echo $form->labelEx($model,'place_family'); ?>
		<?php echo $form->textField($model,'place_family',array(
			'placeholder'=>'Enter '.$model->getAttributeLabel('place_family'),
			'size'=>10,
			'maxlength'=>10
		)); ?>
		<?php echo $form->error($model,'place_family'); ?>
	</span>
	<span class="right13">
		<?php echo $form->labelEx($model,'num_priests'); ?>
		<?php echo $form->textField($model,'num_priests',array(
			'placeholder'=>'Enter '.$model->getAttributeLabel('num_priests'),
			'size'=>10,
			'maxlength'=>10
		)); ?>
		<?php echo $form->error($model,'num_priests'); ?>
	</span>
	<span class="right13">
		<?php echo $form->labelEx($model,'num_nuns'); ?>
		<?php echo $form->textField($model,'num_nuns',array(
			'placeholder'=>'Enter '.$model->getAttributeLabel('num_nuns'),
			'size'=>10,
			'maxlength'=>10
		)); ?>
		<?php echo $form->error($model,'num_nuns'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'baptism_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'baptism_dt',
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
		<?php echo $form->error($model,'baptism_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'baptism_place'); ?>
		<?php echo $form->textField($model,'baptism_place',array(
			'placeholder'=>'Enter '.$model->getAttributeLabel('baptism_place'),
			'size'=>30,
			'maxlength'=>100
		)); ?>
		<?php echo $form->error($model,'baptism_place'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'confirmation_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'confirmation_dt',
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
		<?php echo $form->error($model,'confirmation_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'confirmation_place'); ?>
		<?php echo $form->textField($model,'confirmation_place',array(
			'placeholder'=>'Enter '.$model->getAttributeLabel('confirmation_place'),
			'size'=>30,
			'maxlength'=>100
		)); ?>
		<?php echo $form->error($model,'confirmation_place'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'joining_dt'); ?>
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
		<?php echo $form->error($model,'joining_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'joining_place'); ?>
		<?php echo $form->textField($model,'joining_place',array(
			'placeholder'=>'Enter '.$model->getAttributeLabel('joining_place'),
			'size'=>30,
			'maxlength'=>100
		)); ?>
		<?php echo $form->error($model,'joining_place'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'vestition_dt'); ?>
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
		<?php echo $form->error($model,'vestition_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'vestition_place'); ?>
		<?php echo $form->textField($model,'vestition_place',array(
			'placeholder'=>'Enter '.$model->getAttributeLabel('vestition_place'),
			'size'=>30,
			'maxlength'=>100
		)); ?>
		<?php echo $form->error($model,'vestition_place'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'first_commitment_dt'); ?>
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
		<?php echo $form->error($model,'first_commitment_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'first_commitment_place'); ?>
		<?php echo $form->textField($model,'first_commitment_place',array(
			'placeholder'=>'Enter '.$model->getAttributeLabel('first_commitment_place'),
			'size'=>30,
			'maxlength'=>100
		)); ?>
		<?php echo $form->error($model,'first_commitment_place'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'final_commitment_dt'); ?>
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
		<?php echo $form->error($model,'final_commitment_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'final_commitment_place'); ?>
		<?php echo $form->textField($model,'final_commitment_place',array(
			'placeholder'=>'Enter '.$model->getAttributeLabel('final_commitment_place'),
			'size'=>30,
			'maxlength'=>100
		)); ?>
		<?php echo $form->error($model,'final_commitment_place'); ?>
	</span>
	</div>

	<?php if (!$model->isNewRecord): ?>
	</div><!-- end of div.rightSection -->
	<?php endif ?>

	<div class="row">
	<span class="left34">
		<?php echo $form->labelEx($model,'fathers_name'); ?>
		<?php echo $form->textField($model,'fathers_name',array('placeholder'=>'Enter Fathers Fullname','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'fathers_name'); ?>
	</span>
	<span class="right14">
		<?php echo $form->labelEx($model,'father_alive',array('label'=>'Alive?')); ?>
		<?php echo $form->checkBox($model,'father_alive'); ?>
		<?php echo $form->error($model,'father_alive'); ?>
	</span>
	</div>

	<div class="row">
	<span class="left34">
		<?php echo $form->labelEx($model,'mothers_name'); ?>
		<?php echo $form->textField($model,'mothers_name',array('placeholder'=>'Enter Mothers Fullname','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'mothers_name'); ?>
	</span>
	<span class="right14">
		<?php echo $form->labelEx($model,'mother_alive',array('label'=>'Alive?')); ?>
		<?php echo $form->checkBox($model,'mother_alive'); ?>
		<?php echo $form->error($model,'mother_alive'); ?>
	</span>
	</div>

	<div class="row">
	<span class="left23">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50,'placeholder'=>'Enter Residential Address')); ?>
		<?php echo $form->error($model,'address'); ?>
	</span>
	<span class="right13" style="float:right">
	<div>
		<?php echo $form->labelEx($model,'home_phone'); ?>
		<?php echo $form->telField($model,'home_phone',array('size'=>15,'maxlength'=>15,'placeholder'=>'Enter Home Phone')); ?>
		<?php echo $form->error($model,'home_phone'); ?>
	</div>
	<div>
		<?php echo $form->labelEx($model,'home_mobile'); ?>
		<?php echo $form->telField($model,'home_mobile',array('size'=>15,'maxlength'=>15,'placeholder'=>'Enter Home Mobile')); ?>
		<?php echo $form->error($model,'home_mobile'); ?>
	</div>
	</span>
	</div>

	<div class="row">
	<?php	echo $form->labelEx($model,'mother_tongue');
		echo $form->dropDownList($model,'mother_tongue',FieldNames::values('languages'),array('prompt'=>'-- Select --'));
		echo $form->error($model,'mother_tongue'); ?>
	</div>

	<div style="clear:both">
	<div class="row">
		<?php echo $form->labelEx($model,'parish'); ?>
		<?php echo $form->textField($model,'parish',array('size'=>50,'maxlength'=>50,'placeholder'=>'Enter Parish')); ?>
		<?php echo $form->error($model,'parish'); ?>
	</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diocese'); ?>
		<?php echo $form->textField($model,'diocese',array('size'=>30,'maxlength'=>30,'placeholder'=>'Enter Diocese')); ?>
		<?php echo $form->error($model,'diocese'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'edu_joining'); ?>
		<?php echo $form->textField($model,'edu_joining',array('size'=>50,'maxlength'=>50,'placeholder'=>'Enter Education when Joining')); ?>
		<?php echo $form->error($model,'edu_joining'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'edu_present'); ?>
		<?php echo $form->textField($model,'edu_present',array('size'=>50,'maxlength'=>50,'placeholder'=>'Enter Education at Present')); ?>
		<?php echo $form->error($model,'edu_present'); ?>
	</div>

	<div class="row">
	<?php echo CHtml::label('Languages Spoken', null);
		$languages = FieldNames::values('languages');
		foreach ($languages as $lid => $lv) {
			echo '<label class="cblabel" for="slang_'.$lid.'">'.$lv." ";
			echo CHtml::checkBox('spokenLang[]', in_array($lid, $setSpokenLangs), array('id'=>"slang_".$lid, 'value'=>$lid));
			echo '</label>';
		} ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model, 'teach_lang');
		echo $form->dropDownList($model, 'teach_lang', $languages, array('prompt' => '-- Select one --'));
		echo $form->error($model, 'teach_lang');
	?>		
	</div>

	<div class="row">
	<?php echo CHtml::label('Specialization', null);
		foreach ($specializations as $spec) {
			echo '<label class="cblabel" for="spec_'.$spec->id.'">'.$spec->name." ";
			echo CHtml::checkBox('specialization[]', in_array($spec->id, $setSpecs), array('id'=>"spec_".$spec->id, 'value' => $spec->id));
			echo '</label>';
		} ?>
	</div>

	<div class="row">
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'leaving_dt'); ?>
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
		<?php echo $form->error($model,'leaving_dt'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'mission'); ?>
		<?php echo $form->checkBox($model,'mission'); ?>
		<?php echo $form->error($model,'mission'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'generalate'); ?>
		<?php echo $form->checkBox($model,'generalate'); ?>
		<?php echo $form->error($model,'generalate'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'swiss_visit'); ?>
		<?php echo $form->checkBox($model,'swiss_visit'); ?>
		<?php echo $form->error($model,'swiss_visit'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'holyland_visit'); ?>
		<?php echo $form->checkBox($model,'holyland_visit'); ?>
		<?php echo $form->error($model,'holyland_visit'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'family_abroad'); ?>
		<?php echo $form->checkBox($model,'family_abroad'); ?>
		<?php echo $form->error($model,'family_abroad'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'annual_checkups'); ?>
		<?php echo $form->checkBox($model,'annual_checkups'); ?>
		<?php echo $form->error($model,'annual_checkups'); ?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'health_data'); ?>
		<?php echo $form->textArea($model,'health_data',array('rows'=>4, 'cols'=>50,'placeholder'=>'Enter Health Data')); ?>
		<?php echo $form->error($model,'health_data'); ?>
	</div>

	<div class="row">
	<span class="leftHalf"><?php
		echo $form->labelEx($model,'age_retired');
		echo $form->textField($model,'age_retired',array('size'=>5,'maxlength'=>10,'placeholder'=>$model->getAttributeLabel('age_retired')));
		echo $form->error($model,'age_retired');
	?></span>
	<span class="rightHalf"><?php
		echo $form->labelEx($model,'pension_amt');
		echo $form->textField($model,'pension_amt',array('size'=>6,'maxlength'=>11,'placeholder'=>$model->getAttributeLabel('pension_amt')));
		echo $form->error($model,'pension_amt');
	?></span>
	</div>

	<div class="row"><?php
		echo $form->labelEx($model,'last_illness_nature');
		echo $form->textField($model,'last_illness_nature',array('size'=>60,'maxlength'=>100,'placeholder'=>'Enter '.$model->getAttributeLabel('last_illness_nature')));
		echo $form->error($model,'last_illness_nature');
	?></div>

	<div class="row">
	<span class="leftHalf"><?php
		echo $form->labelEx($model,'demise_dt');
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
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
		));
		echo $form->error($model,'decease_dt'); ?>
	</span>
	<span class="rightHalf">
	<?php
		echo $form->labelEx($model,'decease_time');
		echo $form->textField($model, 'decease_time', array('placeholder'=>'hh:mm:ss','size'=>10,'maxlength'=>10));
		echo $form->error($model,'decease_time');
	?>
	</span>
	</div>

	<div class="row"><?php
		echo $form->labelEx($model,'convent_decease');
		echo $form->textField($model,'convent_decease',array('placeholder'=>'Enter '.$model->getAttributeLabel('convent_decease'),'size'=>60,'maxlength'=>100));
		echo $form->error($model,'convent_decease');
	?></div>

	<div class="row"><?php
		echo $form->labelEx($model,'funeral_celebrant');
		echo $form->textField($model,'funeral_celebrant',array('placeholder'=>'Enter '.$model->getAttributeLabel('funeral_celebrant'),'size'=>60,'maxlength'=>100));
		echo $form->error($model,'funeral_celebrant');
	?></div>

	<div class="row"><?php
		echo $form->labelEx($model,'burial_place');
		echo $form->textField($model,'burial_place',array('placeholder'=>'Enter '.$model->getAttributeLabel('burial_place'),'size'=>60,'maxlength'=>100));
		echo $form->error($model,'burial_place');
	?></div>

	<div class="row"><?php
		echo $form->labelEx($model,'cemetery');
		echo $form->textField($model,'cemetery',array('placeholder'=>'Enter '.$model->getAttributeLabel('cemetery'),'size'=>60,'maxlength'=>100));
		echo $form->error($model,'cemetery');
	?></div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
