<?php namespace App\Http\Controllers;

use View;

class ManualController extends Controller {

	public function getAscii()
	{
		return View::make('manual.ascii');
	}

	public function getJquery()
	{
		return View::make('manual.jquery');
	}

	public function getHttpStatusCode()
	{
		return View::make('manual.http-status-code');
	}
}