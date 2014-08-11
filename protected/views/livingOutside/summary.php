<?php
	$nLO = count($livingOutside) - 1;
	$xtra = $nLO ? " +$nLO" : "";
	$lo = $model->latestLivingOutside;
	echo $lo->institution .
		" (since " . $lo->year_from . ")$xtra";
?>
