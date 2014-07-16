<?php
	$rwls = array();
	$i = 0;
	$xtra = "";
	foreach($renewals as $rwl) {
		if (++$i > 2) {
			$xtra = " +" . (count($renewals) - $i + 1);
			break;
		}
		array_push($rwls, $rwl->renewal_dt);
	}
	$rwlstr = implode(", ", $rwls) . $xtra;
	echo $rwlstr;
?>
