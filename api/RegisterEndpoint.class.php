<?php
require_once 'BaseApi.class.php';
require_once '../db/master-list.php';

class RegisterEndpoint extends BaseAPI {

	function __construct($request) {
		parent::__construct($request);
	}

	function processAPI() {
		$method = parent::getMethod();
		$file = parent::getFile();

		if ($method == 'POST' && is_array($file)) {
			$this->registerUser($file);
			return;
		}

		// default
		$ie = new InvalidEndpoint(parent::getOriginalRequest());
		$ie->processAPI();
	}

	function registerUser($input) {
		$userId = db_createNewUser($input);
		if ($userId === false) {
			parent::_sendResponse(array('Error' => 'An error occurred', 500));
		} else {
			$user = db_getUserProfile($userId);
			parent::_sendResponse($user);
		}
	}
}