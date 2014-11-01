<?php
require_once 'BaseApi.class.php';
require_once '../db/master-list.php';

class ProfileEndpoint extends BaseAPI {

	function __construct($request) {
		parent::__construct($request);
	}

	function processAPI() {
		$method = parent::getMethod();
		$args = parent::getArgs();

		if ($method == 'GET' && count($args) == 1) {
			$this->getUserProfile($args[0]);
			return;
		}

		// default
		$ie = new InvalidEndpoint(parent::getOriginalRequest());
		$ie->processAPI();
	}

	function getUserProfile($id) {
		$result = db_getUserProfile($id);
		if (is_array($result)) {
			$data = $result;
			unset($data['password']);
			parent::_sendResponse($data);
		} else {
			$data = array('Error' => 'No user found with the ID ' . $id);
			parent::_sendResponse($data, 404);
		}
	}
}