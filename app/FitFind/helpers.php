<?php

/**
 * Returns an array of models formatted
 * for easily implementing a specified number of
 * columns per row in a view.
 *
 * @return Array of models indexed by row number
 */
function htmlRows($models, $columns = 3)
{
	$rowStructure = array();
	$row = 0;
	$x = 0;
	$pass = 0;
	foreach($models as $m)
	{
		if($x % $columns === 0)
		{
			if($pass !== 0) $row++;
			$rowStructure[$row] = array();
			$pass++;
		}
		$rowStructure[$row][] = $m;
		$x++;
	}

	return $rowStructure;
}