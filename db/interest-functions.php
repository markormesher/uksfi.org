<?php

/**
 * Register interest from a user on a given listing
 */
function db_registerInterest($listingId, $userId) {
	$listing = db_getListing($listingId);
	insert('interest', array(
		'listing_id' => $listingId,
		'user_id' => $userId
	));
	notifyInterestExpressed($listing['donor_id'], $userId, $listingId);
}

/**
 * Check whether a user has registered interest on a listing
 */
function db_checkInterest($listingId, $userId) {
	$result = search('listings', array(1,
		'`listing_id` = ' . $listingId,
		'`user_id` = ' . $userId
	));
	return is_array($result) && count($result);
}