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
		$fields = array('email', 'password', 'name', 'company_name', 'phone_1', 'phone_2', 'address_1', 'address_2', 'address_3', 'city', 'postcode', 'country', 'user_type', 'bio');
		$dbInsert = array();
		$dbInsert['joined'] = array('NOW()');
		$dbInsert['active'] = array('NOW()');
		foreach ($fields as $f) {
			if (isset($input[$f])) {
				if ($f == 'password') {
					$dbInsert[$f] = array('SHA1(\'' . $input[$f] . '\')');
				} else {
					$dbInsert[$f] = $input[$f];
				}
			}
		}
		$userId = insert('users', $dbInsert);
		if ($userId === false) {
			parent::_sendResponse(array('Error' => 'An error occurred', 500));
		} else {
			$user = db_getUserProfile($userId);
			parent::_sendResponse($user);
		}
	}
}