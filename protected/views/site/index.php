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

<div class='flash-notice'><?php echo $title ?></div>

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
		'mobile',
		'email',
	)
)); ?>
