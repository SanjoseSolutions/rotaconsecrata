<?php
	$a_courses = array();
	$i = 0;
	$xtra = "";
	foreach($courses as $course) {
		if (++$i > 2) {
			$xtra = " +" . (count($courses) - $i + 1);
			break;
		}
		array_push($a_courses, $course->name);
	}
	$coursestr = implode(", ", $a_courses) . $xtra;
	echo $coursestr;
?>
