<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/donate-organs.js');
/* @var $this MembersController */
/* @var $model Members */

$this->breadcrumbs=array(
	'Members'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Members', 'url'=>array('index'), 'visible' => Yii::app()->user->checkAccess('ProvAdmin')),
	array('label'=>'Create Member', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('ProvAdmin')),
	array('label'=>'View Member', 'url'=>array('view', 'id'=>$model->id), 'visible' => Yii::app()->user->checkAccess('ProvAdm')),
	array('label'=>'View Self', 'url'=>array('selfView'), 'visible' => !Yii::app()->user->checkAccess('ProvAdm')),
	array('label'=>'Manage Members', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('ProvAdmin')),
);
?>

<h1>Update Member <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array(
	'model'=>$model,
	'specializations'=>$specializations,
	'setSpecs'=>$setSpecs,
	'setSpokenLangs'=>$setSpokenLangs,
)); ?>
