<?php

function createHtmlRows($numRows = 3)
{
	$htmlVenues = array();
	$row = 0;
	$x = 0;
	$pass = 0;
	foreach($venues as $v)
	{
		if($x % $numRows === 0)
		{
			if($pass !== 0) $row++;
			$htmlVenues[$row] = array();
			$pass++;
		}
		$htmlVenues[$row][] = $v;
		$x++;
	}

	return $htmlVenues;
}