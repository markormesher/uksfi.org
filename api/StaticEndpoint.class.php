<?php
require_once 'BaseApi.class.php';

class StaticEndpoint extends BaseAPI {

	function __construct($request) {
		parent::__construct($request);
	}

	function processAPI() {
		$method = parent::getMethod();
		$verb = parent::getVerb();

		if ($method == 'GET' && $verb == 'foodtypes') {
			$data = array();
			$data['canfood'] = 'Canned Food';
			$data['packfood'] = 'Packaged Food (Unopened)';
			$data['confec'] = 'Confectionery';
			$data['drinks'] = 'Bottled Soft Drinks';
			$data['fresh'] = 'Fresh Food';
			$data['frozen'] = 'Frozen Food';
			$data['ingred'] = 'Basic Ingredients';
			parent::_sendResponse($data);
			return;
		}

		// default
		$ie = new InvalidEndpoint(parent::getOriginalRequest());
		$ie->processAPI();
	}

}