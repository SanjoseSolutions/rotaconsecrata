<?php
	echo "<div id='$fld-summary' class='fields'>";
	$abbr = MultiFieldNames::get($fld)->abbr;
	echo CHtml::label($abbr . ': ', false);
	if ($model->getMemberFieldData($fld)) {
		echo "<span class='val'>";
		$this->renderPartial('/multiFieldData/summary', array('data'=>$model->getMemberFieldData($fld)));
		echo "</span> ";
		$lbl = CHtml::image(Yii::app()->request->baseUrl."/images/edit.png", "Edit", array('height'=>14,'width'=>14,'title'=>'Edit'));;
	} else {
		$lbl = "Add";
	}
	echo CHtml::link($lbl, array('/members/multiFieldData',
		'id'=>$model->id, 'fieldName'=>$fld), array('id' => 'add-'.$fld));
	echo "</div>";
?>
