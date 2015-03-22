<?php namespace App\Http\Controllers;

use View;
use Input;
use App\Exceptions\Exception as ToolsException;

class EncryptController extends Controller {

	public function getpostHash($query = null)
	{
		if (is_null($query))
		{
			$query = Input::get('query', '123456');
		}
		$this->validate(compact('query'), ['query' => 'max:2000']);
		$algos = $this->getSortedHashAlgos();
		return View::make('encrypt.hash', compact('algos', 'query'));
	}

	public function getHmac()
	{
		$algos   = $this->getSortedHashAlgos();
		$default = ['query' => '', 'algo' => 'sha1', 'key' => ''];
		return View::make('encrypt.hmac', array_merge(compact('algos'), $default));
	}

	public function postHmac()
	{
		$input = Input::only('algo', 'query', 'key');
		$this->validate($input, ['query' => 'max:2000', 'algo' => 'required', 'key' => 'max:512']);
		$algos = $this->getSortedHashAlgos();
		if ( ! in_array($input['algo'], $algos))
		{
			throw new ToolsException('不支持该算法', ToolsException::CODE_BAD_PARAMS);
		}
		$result = hash_hmac($input['algo'], $input['query'], $input['key']);
		return View::make('encrypt.hmac', array_merge(compact('algos', 'result'), $input));
	}

	private function getSortedHashAlgos()
	{
		$commonAlgos = ['md5', 'sha1', 'sha256', 'sha512'];
		$algos = hash_algos();
		$algos = array_diff($algos, array_intersect($commonAlgos, $algos));
		sort($algos);
		return array_merge($commonAlgos, $algos);
	}

}