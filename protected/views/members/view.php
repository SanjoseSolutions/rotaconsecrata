<?php
/* @var $this MembersController */
/* @var $model Members */

$this->breadcrumbs=array(
	'Members'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Members', 'url'=>array('index')),
	array('label'=>'Create Members', 'url'=>array('create')),
	array('label'=>'Update Members', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Members', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Members', 'url'=>array('admin')),
);
?>

<h1>View Members #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fullname',
		'photo',
		'maiden_name',
		'mobile',
		'dob',
		'joining_dt',
		'vestation_dt',
		'first_commitment_dt',
		'final_commitment_dt',
		'fathers_name',
		'mothers_name',
		'father_alive',
		'mother_alive',
		'address',
		'home_phone',
		'home_mobile',
		'parish',
		'diocese',
		'demise_dt',
		'leaving_dt',
		'mission',
		'generalate',
		'community',
		'updated_by',
		'updated_on',
		'swiss_visit',
		'holyland_visit',
		'family_abroad',
	),
)); ?>
