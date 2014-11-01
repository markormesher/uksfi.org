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
	if ($result == null || !is_array($result)) {
		return false;
	} else {
		return $result[0];
	}
}