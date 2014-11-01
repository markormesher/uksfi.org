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
		$file = parent::getFile();

		if ($method == 'GET' && count($args) == 1 && array_key_exists('user_id', $qs)) {
			$this->getListing($args[0], $qs);
			return;
		} elseif ($method == 'GET' && array_key_exists('user_id', $qs)) {
			$this->getListings($qs);
			return;
		} elseif ($method == 'POST') {
			$this->createListing($file);
			return;
		}

		// default
		$ie = new InvalidEndpoint(parent::getOriginalRequest());
		$ie->processAPI();
	}

	function getListing($id, $qs) {
		$result = db_getListing($id, $qs['user_id']);
		if (is_array($result)) {
			$data = $result;
			parent::_sendResponse($data);
		} else {
			$data = array('Error' => 'No listing found with the ID ' . $id);
			parent::_sendResponse($data, 404);
		}
	}

	function getListings($filters) {
		// get user id
		$userId = $filters['user_id'];
		unset($filters['user_id']);

		// process filters
		foreach  ($filters as $k => $v) {
			$filters[$k] = explode(',', $v);
		}

		// run query
		$result = db_getListings($filters, $userId);
		if ($result !== false) {
			$data = $result;
			parent::_sendResponse($data);
		} else {
			$data = array('Error' => 'An error occurred when querying the database');
			parent::_sendResponse($data, 500);
		}
	}

	function createListing($input) {
		$listingId = db_createNewListing($input);
		if ($listingId === false) {
			parent::_sendResponse(array('Error' => 'An error occurred', 500));
		} else {
			$listing = db_getListing($listingId);
			parent::_sendResponse($listing);
		}
	}
}