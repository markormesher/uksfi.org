<?php
require_once 'BaseApi.class.php';
require_once '../db/master-list.php';

class LoginEndpoint extends BaseAPI {

	function __construct($request) {
		parent::__construct($request);
	}

	function processAPI() {
		$method = parent::getMethod();
		$qs = parent::getQueryString();

		if ($method == 'GET' && array_key_exists('email', $qs) && array_key_exists('password', $qs)) {
			$this->checkLogin($qs['email'], $qs['password']);
			return;
		}

		// default
		$ie = new InvalidEndpoint(parent::getOriginalRequest());
		$ie->processAPI();
	}

	function checkLogin($email, $password) {
		$result = db_checkLogin($email, $password);
		if (is_array($result)) {
			$data = $result;
			parent::_sendResponse($data);
		} else {
			$data = array('Error' => 'Invalid username/password combination');
			parent::_sendResponse($data, 403);
		}
	}
}