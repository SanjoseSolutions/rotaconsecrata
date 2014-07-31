<?php
	$a_travels = array();
	$i = 0;
	$xtra = "";
	foreach($travels as $travel) {
		if (++$i > 2) {
			$xtra = " +" . (count($travels) - $i + 1);
			break;
		}
		array_push($a_travels, $travel->places);
	}
	$travelstr = implode(", ", $a_travels) . $xtra;
	echo $travelstr;
?>
