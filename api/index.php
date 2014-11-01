<?php

// get classes
require_once 'InvalidEndpoint.class.php';
require_once 'ListingEndpoint.class.php';
require_once 'LoginEndpoint.class.php';
require_once 'PreferenceEndpoint.class.php';
require_once 'ProfileEndpoint.class.php';

// get database
require_once '../connections/sql.php';

// request sent from client
$request = $_REQUEST['request'];

// collect arguments, endpoint and verb
$args = explode('/', rtrim($request, '/'));
$version = strtolower(array_shift($args));
$endpoint = strtolower(array_shift($args));

// which versions are currently alive?
$aliveVersions = array('v1');
if (!in_array($version, $aliveVersions)) {
	$api = new InvalidEndpoint($request);
	$api->processAPI();
	exit;
}

// decide which endpoint to use
switch ($endpoint) {

	case 'login':
		$api = new LoginEndpoint($request);
		break;

	case 'listing':
		$api = new ListingEndpoint($request);
		break;

	case 'prefs':
	case 'preferences':
		$api = new PreferenceEndpoint($request);
		break;

	case 'profile':
		$api = new ProfileEndpoint($request);
		break;

	default:
		$api = new InvalidEndpoint($request);
		break;
}

// execute!
$api->processAPI();