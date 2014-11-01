<?php

/**
 * Check user login details - returns profile or false
 */
function db_checkLogin($email, $password) {
	$filter = array(1,
		'`email` = \'' . $email . '\'',
		'`password` = SHA1(\'' . $password . '\')'
	);
	$result = search('users', $filter, 1);
	if ($result === false || !is_array($result)) {
		return false;
	} else {
		return $result[0];
	}
}

/**
 * Get a user profile
 */
function db_getUserProfile($id) {
	$filter = array(1,
		'`id` = ' . $id
	);
	$result = search('users', $filter, 1);
	if ($result === false || !is_array($result)) {
		return false;
	} else {
		return $result[0];
	}
}

/**
 * Get a user's setting for a certain preference, or return the default
 */
function db_getUserPref($userId, $prefName) {
	// try user pref
	$filter = array(1,
		'`user_id` = ' . $userId,
		'`pref_name` = \'' . $prefName . '\''
	);
	$userValue = search('preferences', $filter, 1);
	if ($userValue === false || !is_array($userValue)) {
		// resort to default
		$filter = array(1,
			'`pref_name` = \'' . $prefName . '\''
		);
		$defaultValue = search('default_preferences', $filter, 1);
		if ($defaultValue === false || !is_array($defaultValue)) {
			return false;
		} else {
			return $defaultValue[0];
		}
	} else {
		return $userValue[0];
	}
}

/**
 * Gets multiple preferences for a user, or returns default
 */
function db_getMultiUserPref($userId, $prefNames) {
	$output = array();
	foreach ($prefNames as $p) {
		$pref =db_getUserPref($userId, $p);
		if ($pref !== false) {
			$output[$p] = $pref['pref_value'];
		} else {
			$output[$p] = false;
		}
	}
	return $output;
}