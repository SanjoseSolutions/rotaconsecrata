<?php
	echo "<div id='$course-courses-summary' class='fields'>";
	$title = AcademicCourseNames::get($course)->title;
	echo CHtml::label($title . ': ', false);
	if ($model->getCourseData($course)) {
		echo "<span class='val'>";
		$this->renderPartial('/academicCourses/summary', array('courses'=>$model->getCourseData($course)));
		echo "</span> ";
		$lbl = CHtml::image(Yii::app()->request->baseUrl."/images/edit.png", "Edit", array('height'=>14,'width'=>14,'title'=>'Edit'));;
	} else {
		$lbl = "Add";
	}
	echo CHtml::link($lbl, array('/members/academicCourses',
		'id'=>$model->id, 'course'=>$course), array('id' => 'add-'.$course.'-courses'));
	echo "</div>";
?>
