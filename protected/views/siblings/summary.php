<?php
	$sibs = array();
	$i = 0;
	$xtra = "";
	foreach($siblings as $sib) {
		if (++$i > 2) {
			$xtra = " +" . (count($siblings) - $i + 1);
			break;
		}
		array_push($sibs, $sib->fullname);
	}
	$sibstr = implode(", ", $sibs) . $xtra;
	echo $sibstr;
?>
