<?php
	echo "<div id='$fld-summary' class='fields'>";
	$abbr = MultiFieldNames::get($fld)->abbr;
	$lbl = "Add $abbr";
	if ($model->getMemberFieldData($fld)) {
		echo CHtml::label($abbr . ': ', false);
		echo "<span class='val'>";
		$this->renderPartial('/multiFieldData/summary', array('data'=>$model->getMemberFieldData($fld)));
		echo "</span> ";
		$lbl = "Edit";
	}
	echo CHtml::link($lbl, array('/members/multiFieldData',
		'id'=>$model->id, 'fieldName'=>$fld), array('id' => 'add-'.$fld));
	echo "</div>";
?>
