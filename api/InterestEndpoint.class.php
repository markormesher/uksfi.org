<?php
require_once 'BaseApi.class.php';
require_once '../db/master-list.php';

class InterestEndpoint extends BaseAPI {

	function __construct($request) {
		parent::__construct($request);
	}

	function processAPI() {
		$method = parent::getMethod();
		$qs = parent::getQueryString();
		$file = parent::getFile();

		if ($method == 'GET' && array_key_exists('listing_id', $qs) && array_key_exists('user_id', $qs)) {
			$this->checkInterest($qs['listing_id'], $qs['user_id']);
			return;
		} elseif ($method == 'POST' && array_key_exists('listing_id', $file) && array_key_exists('user_id', $file)) {
			$this->registerInterest($file['listing_id'], $file['user_id']);
			return;
		}

		// default
		$ie = new InvalidEndpoint(parent::getOriginalRequest());
		$ie->processAPI();
	}

	function checkInterest($listingId, $userId) {
		if (db_checkInterest($listingId, $userId)) {
			parent::_sendResponse(array(), 200);
		} else {
			parent::_sendResponse(array(), 404);
		}
	}

	function registerInterest($listingId, $userId) {
		db_registerInterest($listingId, $userId);
		parent::_sendResponse(array(), 200);
	}
}