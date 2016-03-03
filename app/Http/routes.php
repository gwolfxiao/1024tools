<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// SiteController
Route::get('/', ['uses' => 'SiteController@getHome', 'as' => 'site.home']);
Route::get('/site/captcha', ['uses' => 'SiteController@getCaptcha', 'as' => 'site.captcha']);
Route::get('/site/ajax/tools', ['uses' => 'SiteController@getTools', 'as' => 'site.ajax.tools']);
Route::get('/site/browserdetect', ['uses' => 'SiteController@getBrowserDetect', 'as' => 'site.browserDetect']);

// ConvertController
Route::get('/base64', ['uses' => 'ConvertController@getBase64', 'as' => 'convert.base64']);
Route::post('/base64', ['uses' => 'ConvertController@postBase64', 'as' => 'convert.base64.post']);
Route::get('/urlencode', ['uses' => 'ConvertController@getUrlencode', 'as' => 'convert.urlencode']);
Route::post('/urlencode', ['uses' => 'ConvertController@postUrlencode', 'as' => 'convert.urlencode.post']);
Route::get('/less', ['uses' => 'ConvertController@getLess', 'as' => 'convert.less']);
Route::post('/less', ['uses' => 'ConvertController@postLess', 'as' => 'convert.less.post']);
Route::get('/xmljson', ['uses' => 'ConvertController@getXmlJson', 'as' => 'convert.xmljson']);
Route::get('/markdown', ['uses' => 'ConvertController@getMarkdown', 'as' => 'convert.markdown']);
Route::get('/timestamp', ['uses' => 'ConvertController@getTimestamp', 'as' => 'convert.timestamp']);
Route::get('/unserialize', ['uses' => 'ConvertController@getUnserialize', 'as' => 'convert.unserialize']);
Route::post('/unserialize', ['uses' => 'ConvertController@postUnserialize', 'as' => 'convert.unserialize.post']);

// FormatController
Route::get('/json', ['uses' => 'FormatController@getJson', 'as' => 'format.json']);
Route::get('/highlight', ['uses' => 'FormatController@getHighlight', 'as' => 'format.highlight']);
Route::get('/sqlformat', ['uses' => 'FormatController@getSql', 'as' => 'format.sql']);
Route::post('/sqlformat', ['uses' => 'FormatController@postSql', 'as' => 'format.sql.post']);

// EncryptController
Route::match(['GET', 'POST'], '/hash/{query?}', ['uses' => 'EncryptController@getpostHash', 'as' => 'encrypt.hash']);
Route::get('/hmac', ['uses' => 'EncryptController@getHmac', 'as' => 'encrypt.hmac']);
Route::post('/hmac', ['uses' => 'EncryptController@postHmac', 'as' => 'encrypt.hmac.post']);

// HttpController
Route::get('/header', ['uses' => 'HttpController@getHeader', 'as' => 'http.header']);
Route::get('/ip/{ip?}', ['uses' => 'HttpController@getIp', 'as' => 'http.ip']);
Route::get('/ip/proxy/sina', ['uses' => 'HttpController@getIpSina', 'as' => 'http.ip.proxy.sina']);
Route::get('/ip/proxy/taobao', ['uses' => 'HttpController@getIpTaobao', 'as' => 'http.ip.proxy.taobao']);
Route::get('/ip/proxy/pconline', ['uses' => 'HttpController@getIpPconline', 'as' => 'http.ip.proxy.pconline']);
Route::get('/ip/proxy/ipapi', ['uses' => 'HttpController@getIpIpApi', 'as' => 'http.ip.proxy.ipapi']);
Route::get('/ip/proxy/dangdang', ['uses' => 'HttpController@getIpDangdang', 'as' => 'http.ip.proxy.dangdang']);

// ManualController
Route::get('/ascii', ['uses' => 'ManualController@getAscii', 'as' => 'manual.ascii']);
Route::get('/jquery', ['uses' => 'ManualController@getJquery', 'as' => 'manual.jquery']);
Route::get('/http-status-code', ['uses' => 'ManualController@getHttpStatusCode', 'as' => 'manual.httpStatusCode']);

// ExtraController
Route::get('/random', ['uses' => 'ExtraController@getRandom', 'as' => 'extra.random']);
Route::get('/uuid', ['uses' => 'ExtraController@getUuid', 'as' => 'extra.uuid']);
Route::post('/uuid', ['uses' => 'ExtraController@postUuid', 'as' => 'extra.uuid.post']);
