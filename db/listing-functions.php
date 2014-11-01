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

/**
 * Create a new listing
 */
function db_createNewListing($input) {
	$fields = array('donor_id', 'title', 'description', 'address_1', 'address_2', 'address_3', 'city', 'postcode', 'country', 'contains', 'can_deliver');
	$dbInsert = array();
	$dbInsert['posted_on'] = array('NOW()');
	$dbInsert['expires_on'] = array('ADDDATE(NOW(), INTERVAL 7 DAY)');
	foreach ($fields as $f) {
		if (isset($input[$f])) {
			$dbInsert[$f] = $input[$f];
		}
	}
	return insert('listings', $dbInsert);
}