<?php
$action = $model->isNewRecord ? array('/siblings/create') : array('/siblings/update', 'id'=>$model->id);
$form=$this->beginWidget('CActiveForm', array(
	'id' => 'siblings-form',
	'action' => $action,
	'enableAjaxValidation'=>false,
)); ?>

<span class="sib-field">
<?php
	echo $form->labelEx($model, 'fullname');
	echo $form->textField($model, 'fullname');
	echo $form->error($model, 'fullname');
?>
</span>
<span class="sib-field">
<?php
	echo $form->labelEx($model, 'phone');
	echo $form->textField($model, 'phone');
	echo $form->error($model, 'phone');
?>
</span>
<span class="sib-field">
<?php
	echo $form->labelEx($model,'alive',array('label'=>'Alive?'));
	echo $form->checkBox($model,'alive');
	echo $form->error($model, 'alive');
	echo $form->hiddenField($model, 'member_id');
	if (!$model->isNewRecord) {
		echo $form->hiddenField($model, 'id', array('value'=>$model->id));
	}
?>
</span>

<span>
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
</span>

<?php $this->endwidget(); ?>
