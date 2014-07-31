<?php
/* @var $this MembersController */
/* @var $model Members */

$this->breadcrumbs=array(
	'Members'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Members', 'url'=>array('index')),
	array('label'=>'Create Member', 'url'=>array('create')),
	array('label'=>'View Member', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Members', 'url'=>array('admin')),
);
?>

<h1>Update Member <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array(
	'model'=>$model,
	'specializations'=>$specializations,
	'setSpecs'=>$setSpecs,
	'setSpokenLangs'=>$setSpokenLangs,
)); ?>
