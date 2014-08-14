<?php
/* @var $this UserController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Activate',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'View Users', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>Welcome User #<?php echo $model->id.': '.$member->fullname; ?></h1>


<div class='msg'><p>
<?php
	$msg = Yii::app()->user->getFlash('msg');
	if (!empty($msg)) {
		echo $msg;
	} else {
		echo "Kindly activate your account by setting your first time password..";
	}
?>
</p></div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
