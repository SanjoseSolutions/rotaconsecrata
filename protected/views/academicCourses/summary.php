<?php
	$courses = array();
	$i = 0;
	$xtra = "";
	foreach($academicCourses as $course) {
		if (++$i > 2) {
			$xtra = " +" . (count($academicCourses) - $i + 1);
			break;
		}
		array_push($courses, $course->name);
	}
	$coursestr = implode(", ", $courses) . $xtra;
	echo $coursestr;
?>
