<?php
require_once 'BaseApi.class.php';

class InvalidEndpoint extends BaseAPI {

	function __construct($request) {
		parent::__construct($request);
	}

	function processAPI() {
		$data = array();
		$data['error'] = 'Invalid endpoint';
		$data['request'] = $this->getOriginalRequest();
		$data['method'] = $this->getMethod();
		$data['version'] = $this->getVersion();
		$data['endpoint'] = $this->getEndpoint();
		$data['verb'] = $this->getVerb();
		$data['args'] = $this->getArgs();
		$data['queryString'] = $this->getQueryString();
		$this->_sendResponse($data, 400);
	}
}