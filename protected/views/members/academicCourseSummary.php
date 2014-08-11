<?php
	echo "<div id='$course-courses-summary' class='fields'>";
	$title = AcademicCourseNames::get($course)->title;
	$lbl = "Add $title";
	if ($model->getCourseData($course)) {
		echo CHtml::label($title . ': ', false);
		echo "<span class='val'>";
		$this->renderPartial('/academicCourses/summary', array('courses'=>$model->getCourseData($course)));
		echo "</span> ";
		$lbl = "Edit";
	}
	echo CHtml::link($lbl, array('/members/academicCourses',
		'id'=>$model->id, 'course'=>$course), array('id' => 'add-'.$course.'-courses'));
	echo "</div>";
?>
