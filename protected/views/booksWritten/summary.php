<?php
	$books = array();
	$i = 0;
	$xtra = "";
	foreach($booksWritten as $book) {
		if (++$i > 2) {
			$xtra = " +" . (count($booksWritten) - $i + 1);
			break;
		}
		array_push($books, $book->title);
	}
	$bookstr = implode(", ", $books) . $xtra;
	echo $bookstr;
?>
