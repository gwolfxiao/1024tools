<?php namespace App\Support;

use Closure;
use Cache as BaseCache;

class Cache {
	public static function get($key, $expireMinite, Closure $resultCallBack)
	{
		$result = BaseCache::get($key);
		if ( ! $result)
		{
			$result = call_user_func($resultCallBack);
			BaseCache::put($key, $result, $expireMinite);
		}
		return $result;
	}
}