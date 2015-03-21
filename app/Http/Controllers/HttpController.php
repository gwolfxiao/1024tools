<?php namespace App\Http\Controllers;

use View;
use Input;
use Request;
use Response;
use Exception;
use App\Support\Curl;

class HttpController extends Controller {

	public static $ipApis = [
		'sina'     => 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=',
		'taobao'   => 'http://ip.taobao.com/service/getIpInfo.php?ip=',
		'pconline' => 'http://whois.pconline.com.cn/ipJson.jsp?json=true&ip=',
		'ip_api'   => 'http://ip-api.com/json/',
		'dangdang' => 'http://iplookup.dangdang.com/?format=json&ip=',
	];

	public function getHeader()
	{
		$header = '';
		foreach ($_SERVER as $k => $v)
		{
			if (strpos(strtolower($k), 'http_') === 0) {
				if (in_array(strtolower($k), ['http_cookie', 'http_remoteip', 'http_x_forwarded_for'])) {
					continue;
				}
				$name = explode('_', strtolower(substr($k, 5)));
				array_walk($name, function(&$v, $k) {
					$v = ucfirst($v);
				});
				$header .= implode('-', $name).": ".$v."\r\n";
			}
		}
		return View::make('http.header', compact('header'));
	}

	public function getIp($ip = null)
	{
		$ip   = $ip ?: Request::ip();
		$apis = self::$ipApis;
		return View::make('http.ip', compact('ip', 'apis'));
	}

	public function getIpSina()
	{
		$url  = self::$ipApis['sina'].$this->getQueryIp();
		$curl = new Curl;
		$curl->get($url);
		return $this->proxyResponse(empty($curl->curl_error), json_decode($curl->response));
	}

	public function getIpTaobao()
	{
		$url  = self::$ipApis['taobao'].$this->getQueryIp();
		$curl = new Curl;
		$curl->get($url);
		return $this->proxyResponse(empty($curl->curl_error), json_decode($curl->response));
	}

	public function getIpPconline()
	{
		$url  = self::$ipApis['pconline'].$this->getQueryIp();
		$curl = new Curl;
		$curl->get($url);
		return $this->proxyResponse(empty($curl->curl_error), json_decode($curl->response));
	}

	public function getIpIpApi()
	{
		$url  = self::$ipApis['ip_api'].$this->getQueryIp();
		$curl = new Curl;
		$curl->get($url);
		return $this->proxyResponse(empty($curl->curl_error), json_decode(trim($curl->response)));
	}

	public function getIpDangdang()
	{
		$url  = self::$ipApis['dangdang'].$this->getQueryIp();
		$curl = new Curl;
		$curl->get($url);
		return $this->proxyResponse(empty($curl->curl_error), json_decode(trim($curl->response)));
	}

	private function getQueryIp()
	{
		return Input::get('ip', Request::ip());
	}

	private function proxyResponse($status, $return = '')
	{
		$data = ['status' => intval($status), 'data' => $return];
		$response = Response::json($data);
		try {
			$response->setCallback(Input::get('callback'));
		}
		catch (Exception $e) {}
		return $response;
	}
}