<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$this->menu=array(
	array('label'=>'List Members', 'url'=>array('/members/index')),
	array('label'=>'Create Members', 'url'=>array('/members/create')),
	array('label'=>'Manage Members', 'url'=>array('/members/admin')),
	array('label'=>'Advanced Search', 'url'=>array('/members/admin', 'search' => 1)),
);
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'members-grid',
	'dataProvider'=>$provider,
	'enableSorting'=>true,
	'columns'=>array(
		'id',
		array(
			'name' => 'fullname',
			'type' => 'raw',
			'value' => 'CHtml::link($data->fullname, Yii::app()->createUrl("/members/view", array("id" => $data->id)))',
		),
		'dob',
		'fathers_name',
		'mothers_name',
		'joining_dt',
		array(
			'name' => 'First Commitment',
			'value' => '$data->first_commitment_dt',
		),
		array(
			'name' => 'Jub',
			'type' => 'raw',
			'value' => 'CHtml::image(Yii::app()->request->baseUrl . "/images/" . ($data->professed >= 50 ? "gold" : ($data->professed >= 25 ? "silver" : "ph")). "-badge-20.png", "Jubilee")'
#			'value' => 'if ($data->age >= 50) {
#				echo CHtml::image("/images/gold-badge-20.png", "Golden Jubilee", array("width" => 20, "height => 20));
#			} elseif ($data->age >= 25) {
#				echo CHtml::image("/images/silver-badge-20.png", "Golden Jubilee", array("width" => 20, "height => 20));
#			}'
		),
	)
)); ?>
