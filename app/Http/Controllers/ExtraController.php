<?php namespace App\Http\Controllers;

use View;

class ExtraController extends Controller {
	public function getRandom()
	{
		return View::make('extra.random');
	}

	public function getRegex()
	{
		return View::make('extra.regex');
	}
}