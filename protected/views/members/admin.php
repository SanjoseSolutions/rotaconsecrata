<?php
/* @var $this MembersController */
/* @var $model Members */

$this->breadcrumbs=array(
	'Members'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Members', 'url'=>array('index')),
	array('label'=>'Create Members', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#members-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Members</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'members-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fullname',
		'photo',
		'maiden_name',
		'mobile',
		'dob',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
