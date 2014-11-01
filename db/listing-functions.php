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
	return search('listings', array());
}