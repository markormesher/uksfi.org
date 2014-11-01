<?php

/**
 * A listing was posted: find relevant people and notify them
 */
function notifyListingPosted($listingId) {
	// find users
	$users = search('preferences', array(1,
		'`pref_name` = \'r_get_alerts\'',
		'`pref_value` = \'1\''
	));
	if ($users === false) return;

	// send!
	foreach ($users as $u) {
		notifyUserForListing($listingId, $u['user_id']);
	}
}

/**
 * Send a listing notification to one person
 */
function notifyUserForListing($listingId, $userId) {
	$profile = db_getUserProfile($userId);
	$notifications = db_getUserPref($userId, 'r_notify_via');
	foreach ($notifications as $n) {
		switch ($n) {
			case 'yo':
				$yoUsername = $profile['yo_username'];
				$ch = curl_init('http://api.justyo.co/yo');
				curl_setopt($ch, CURLOPT_POST, 3);
				curl_setopt($ch, CURLOPT_POSTFIELDS, 'api_token=6421a408-0365-4aef-968c-09c30908db58&username=' . $yoUsername . '&link=http://www.uksfi.org');
				curl_exec($ch);
				break;

			case 'phone_1';
			case 'phone_2':
				$number = $profile[$n];
				// TODO Twilio
				break;
		}
	}
}