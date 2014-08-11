<?php
	$nOS = count($outsideServices) - 1;
	$xtra = $nOS ? " +$nOS" : "";
	$os = $model->latestOutsideService;
	echo $os->institution .
		" (since " . $os->year_from . ")$xtra";
?>
