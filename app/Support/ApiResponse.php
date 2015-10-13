<?php namespace App\Support;

use Input;
use Response;
use Exception;

class ApiResponse {

	const STATUS_ERROR = 0;
	const STATUS_SUCCESS = 1;

	private static function send($status, $data, $error = null, Exception $exception = null)
	{
		$data = [
			'status' => $status,
			'result' => $data,
			'error'  => $error,
		];
		$response = Response::json($data);
		try {
			$response->setCallback(Input::get('callback'));
		}
		catch (Exception $e) {}
		return $response;
	}

	public static function success($data = null)
	{
		return self::send(self::STATUS_SUCCESS, $data);
	}

	public static function error($error = null, Exception $exception = null)
	{
		return self::send(self::STATUS_ERROR, null, $error, $exception);
	}
}