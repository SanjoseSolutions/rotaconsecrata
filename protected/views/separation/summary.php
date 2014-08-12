<?php
	$nSep = count($separations) - 1;
	$xtra = $nSep ? " +$nSep" : "";
	$sep = $model->latestSeparation;
	echo $sep->nature .
		" (since " . $sep->year_from . ")$xtra";
?>
