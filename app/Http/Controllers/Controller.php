<?php namespace App\Http\Controllers;

use Validator;
use App\Support\ApiResponse;
use App\Exception\Exception as ToolsException;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	/**
	 * Validator类封装
	 */
	protected function validate($data = array(), $rules = array())
	{
		$validator = Validator::make($data, $rules);
		if ($validator->fails())
		{
			throw new ToolsException($validator->messages()->first(), ToolsException::CODE_BAD_PARAMS);
		}
	}

	/**
	 * api响应错误
	 */
	protected function error($error = null)
	{
		return ApiResponse::error($error);
	}

	/**
	 * api响应成功
	 */
	protected function success($data = null)
	{
		return ApiResponse::success($data);
	}
}
