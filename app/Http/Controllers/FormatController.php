<?php namespace App\Http\Controllers;

use View;
use Input;
use Response;
use SqlFormatter;

class FormatController extends Controller {
	public function getJson()
	{
		return View::make('format.json');
	}

	public function getHighlight()
	{
		return View::make('format.highlight');
	}

	public function getSql()
	{
		return View::make('format.sql');
	}

	public function postSql()
	{
		$query = Input::get('query', '');
		$type  = Input::get('type', 'format');
		if ($type == 'compress') {
			$result = "<pre>".SqlFormatter::compress($query)."</pre>";
		} else {
			$result = SqlFormatter::format($query);
		}
		return Response::json(compact('result'));
		//return View::make('format.sql', compact('query', 'result'));
	}
}