<?php
	$nComm = count($commTerms) - 1;
	$xtra = $nComm ? " +$nComm" : "";
	$comm = $model->presentCommunity;
	echo $comm->community->name .
		" (since " . $comm->year_from . ")$xtra";
?>
