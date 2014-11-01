<?php

/**
 * Register interest from a user on a given listing
 */
function db_registerInterest($listingId, $userId) {
	insert('interest', array(
		'listing_id' => $listingId,
		'user_id' => $userId
	));
}

/**
 * Check whether a user has registered interest on a listing
 */
function db_checkInterest($listingId, $userId) {
	$result = search('listings', array(1,
		'listing_id' => $listingId,
		'user_id' => $userId
	));
	return is_array($result) && count($result);
}