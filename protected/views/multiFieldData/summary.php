<?php
	$da = array();
	$i = 0;
	$xtra = "";
	foreach($data as $item) {
		if (++$i > 1) {
			$xtra = " +" . (count($data) - $i + 1);
			break;
		}
		array_push($da, $item->descr);
	}
	$datastr = implode(", ", $da) . $xtra;
	echo $datastr;
?>
