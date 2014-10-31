<?php

require_once '../connections/sql.php';

abstract class BaseAPI {

	private $originalRequest;
	private $request;
	private $method = '';
	private $version = 0;
	private $endpoint = '';
	private $verb = '';
	private $args = array();
	private $querySting = array();
	private $file = null;

	public function __construct($request) {
		// save request
		$this->originalRequest = $request;

		// enable CORS
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: *");

		// everything is JSON
		header("Content-Type: application/json");

		// collect version, endpoint, verb and args
		$this->args = explode('/', rtrim($request, '/'));
		$this->version = strtolower(array_shift($this->args));
		if (substr($this->version, 0, 1) == 'v') {
			$this->version = intval(substr($this->version, 1));
		} else {
			$this->version = 0;
		}
		$this->endpoint = strtolower(array_shift($this->args));
		if (array_key_exists(0, $this->args) && preg_match('/^[a-z]*$/i', $this->args[0])) {
			$this->verb = strtolower(array_shift($this->args));
		}

		// find method
		$this->method = $_SERVER['REQUEST_METHOD'];
		if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
			if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
				$this->method = 'DELETE';
			} else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
				$this->method = 'PUT';
			} else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PATCH') {
				$this->method = 'PATCH';
			} else {
				throw new Exception("Unexpected Header");
			}
		}

		// collect and clean inputs
		$this->querySting = $this->_cleanInputs($_GET);
		$jsonContent = file_get_contents("php://input");
		if (strlen($jsonContent) > 0) {
			$jsonDecoded = json_decode($jsonContent, true);
			if (is_array($jsonDecoded)) {
				$this->file = $jsonDecoded;
			} else {
				$this->_sendResponse(array('Error' => 'Malformed data supplied'), 400);
				exit;
			}
		}
		switch ($this->method) {
			case 'DELETE':
			case 'POST':
			case 'PATCH':
				$this->request = $this->_cleanInputs($_POST);
				break;
			case 'GET':
			case 'PUT':
				$this->request = $this->_cleanInputs($_GET);
				break;
			default:
				$this->_sendResponse('Invalid Method', 405);
				exit;
		}
	}

	// do the actual work of any API endpoint
	abstract function processAPI();

	public function getOriginalRequest() {
		return $this->originalRequest;
	}

	public function getRequest() {
		return $this->request;
	}

	public function getMethod() {
		return $this->method;
	}

	public function getVersion() {
		return $this->version;
	}

	public function getEndpoint() {
		return $this->endpoint;
	}

	public function getVerb() {
		return $this->verb;
	}

	public function getArgs() {
		return $this->args;
	}

	public function getQueryString() {
		return $this->querySting;
	}

	public function getFile() {
		return $this->file;
	}

	// send a correctly formatted HTTP/JSON response to the client
	protected function _sendResponse($data, $status = 200) {
		header('HTTP/1.1 ' . $status . ' ' . $this->_getRequestStatus($status));
		echo $data == null ? '[]' : json_encode($data);
	}

	// clean any inputs
	private function _cleanInputs($data) {
		$clean_input = Array();
		if (is_array($data)) {
			foreach ($data as $k => $v) {
				$clean_input[$k] = $this->_cleanInputs($v);
			}
		} else {
			$clean_input = trim(strip_tags($data));
		}
		return $clean_input;
	}

	// convert a status code to the correct string (e.g. 200 => OK)
	private function _getRequestStatus($code) {
		$statuses = array(
			100 => 'Continue',
			101 => 'Switching Protocols',
			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',
			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Found',
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			306 => '(Unused)',
			307 => 'Temporary Redirect',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Request Entity Too Large',
			414 => 'Request-URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Requested Range Not Satisfiable',
			417 => 'Expectation Failed',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported'
		);
		return ($statuses[$code]) ? $statuses[$code] : $statuses[500];
	}

}