<?php

if ( ! function_exists('statics_path'))
{
	/**
	 * 获取静态文件路径
	 *
	 * @param  string  $name
	 * @param  array   $parameters
	 * @return string
	 */
	function statics_path()
	{
		if (Request::secure() || Cookie::has('old_browser'))
		{
			return '/statics';
		}
		return 'http://statics.1024tools.com';
	}
}
