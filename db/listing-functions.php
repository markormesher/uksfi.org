<?php

/**
 * Get a listing by ID
 */
function db_getListing($id, $userId = 0) {
	$filter = array(1,
		'`id` = \'' . $id . '\''
	);
	$result = search('listings', $filter, 1);
	if ($result === false || !is_array($result)) {
		return false;
	} else {
		$result[0] = array_merge($result[0], array(
			'donor' => db_getUserProfile($result[0]['donor_id'])
		));
		if ($userId > 0) {
			$interest = search('interest', array(1,
				'`user_id` = ' . $userId,
				'`listing_id` = ' . $result[0]['id']
			));
			if ($result[0]['open']) {
				if (is_array($interest) && count($interest)) {
					$result[0]['status'] = 'interested';
				} else {
					$result[0]['status'] = 'open';
				}
			} else {
				$matched = search('matches', array(1,
					'`user_id` = ' . $userId,
					'`listing_id` = ' . $result[0]['id']
				));
				if (is_array($matched) && count($matched)) {
					$result[0]['status'] = 'won';
				} else {
					if (is_array($interest) && count($interest)) {
						$result[0]['status'] = 'lost';
					} else {
						$result[0]['status'] = 'closed';
					}
				}
			}
		}
		return $result[0];
	}
}

/**
 * Get listings matching a set of filters
 */
function db_getListings($filters, $userId = 0) {
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
	$listings = search('listings', $filter, 0, 'ORDER BY `posted_on` DESC');
	$output = array();
	foreach ($listings as $l) {
		$l = array_merge($l, array(
			'donor' => db_getUserProfile($l['donor_id'])
		));
		if ($userId > 0) {
			$interest = search('interest', array(1,
				'`user_id` = ' . $userId,
				'`listing_id` = ' . $l['id']
			));
			if ($l['open']) {
				if (is_array($interest) && count($interest)) {
					$l['status'] = 'interested';
				} else {
					$l['status'] = 'open';
				}
			} else {
				$matched = search('matches', array(1,
					'`user_id` = ' . $userId,
					'`listing_id` = ' . $l['id']
				));
				if (is_array($matched) && count($matched)) {
					$l['status'] = 'won';
				} else {
					if (is_array($interest) && count($interest)) {
						$l['status'] = 'lost';
					} else {
						$l['status'] = 'closed';
					}
				}
			}
		}
		$output[] = $l;
	}
	return $output;
}

/**
 * Create a new listing
 */
function db_createNewListing($input) {
	$fields = array('donor_id', 'title', 'description', 'address_1', 'address_2', 'address_3', 'city', 'postcode', 'country', 'contents', 'can_deliver');
	$dbInsert = array();
	$dbInsert['posted_on'] = array('NOW()');
	$dbInsert['expires_on'] = array('ADDDATE(NOW(), INTERVAL 7 DAY)');
	foreach ($fields as $f) {
		if (isset($input[$f])) {
			$dbInsert[$f] = $input[$f];
		}
	}
	$listingId = insert('listings', $dbInsert);
	notifyListingPosted($listingId);
	return $listingId;
}