<?php
require_once 'BaseApi.class.php';
require_once '../db/master-list.php';

class PreferenceEndpoint extends BaseAPI {

	function __construct($request) {
		parent::__construct($request);
	}

	function processAPI() {
		$method = parent::getMethod();
		$args = parent::getArgs();
		$qs = parent::getQueryString();

		if ($method == 'GET' && count($args) == 1 && array_key_exists('prefs', $qs)) {
			$this->getPreferences($args[0], $qs['prefs']);
			return;
		}

		// default
		$ie = new InvalidEndpoint(parent::getOriginalRequest());
		$ie->processAPI();
	}

	function getPreferences($id, $prefs) {
		$prefs = explode(',', $prefs);
		$data = db_getMultiUserPref($id, $prefs);
		parent::_sendResponse($data);
	}
}