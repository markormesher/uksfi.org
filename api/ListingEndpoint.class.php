<?php
require_once 'BaseApi.class.php';
require_once '../db/master-list.php';

class ListingEndpoint extends BaseAPI {

	function __construct($request) {
		parent::__construct($request);
	}

	function processAPI() {
		$method = parent::getMethod();
		$args = parent::getArgs();
		$qs = parent::getQueryString();

		if ($method == 'GET' && count($args) == 1) {
			$this->getListing($args[0]);
			return;
		} elseif ($method == 'GET') {
			$this->getListings($qs);
			return;
		}

		// default
		$ie = new InvalidEndpoint(parent::getOriginalRequest());
		$ie->processAPI();
	}

	function getListing($id) {
		$result = db_getListing($id);
		if (is_array($result)) {
			$data = $result;
			parent::_sendResponse($data);
		} else {
			$data = array('Error' => 'No listing found with the ID ' . $id);
			parent::_sendResponse($data, 404);
		}
	}

	function getListings($filters) {
		// process filters
		foreach  ($filters as $k => $v) {
			$filters[$k] = explode(',', $v);
		}

		// run query
		$result = db_getListings($filters);
		if ($result !== false) {
			$data = $result;
			parent::_sendResponse($data);
		} else {
			$data = array('Error' => 'An error occurred when querying the database');
			parent::_sendResponse($data, 500);
		}
	}
}