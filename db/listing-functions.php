<?php

/**
 * Get a listing by ID
 */
function db_getListing($id) {
	$filter = array(1,
		'`id` = \'' . $id . '\''
	);
	$result = search('listings', $filter, 1);
	if ($result === false || !is_array($result)) {
		return false;
	} else {
		return $result[0];
	}
}

/**
 * Get listings matching a set of filters
 */
function db_getListings($filters) {
	// parse filters
	$filter = array(1, '1');
	foreach ($filters as $k => $v) {
		switch ($k) {
			case 'contents':
				$temp = array(-1);
				foreach ($v as $vi) $temp[] = '`contents` LIKE \'%' . $vi . '%\'';
				$filter[] = $temp;
				break;
			case 'can_deliver':
				$temp = array(-1);
				foreach ($v as $vi) $temp[] = '`can_deliver` = ' . $vi;
				$filter[] = $temp;
				break;
		}
	}
	return search('listings', $filter);
}