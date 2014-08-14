<?php
/* @var $this UserController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Activate',
);

$this->menu=array(
);
?>

<h1>Welcome User #<?php echo $model->id.': '.$member->fullname; ?></h1>


<?php
$msg = Yii::app()->user->getFlash('msg');
if (!empty($msg)) {
	echo "<div class='flash-success'>$msg</div>";
} else {
	if ($err = Yii::app()->user->getFlash('err')) {
		echo "<div class='flash-error'>$err</div>";
	}
	echo "<p>Kindly activate your account by setting your first time password..</p>";
	$this->renderPartial('_form', array('model'=>$model));
}
?>

