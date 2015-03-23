<?php namespace App\Exceptions;

use Log;
use Request;
use Redirect;
use Response;
use Exception;
use ApiResponse;
use App\Models\Typo;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
		$error = '服务器错误';
		try {
			if ($e instanceof NotFoundHttpException) {
				$context = [
					'url' => Request::fullUrl(),
					'ip' => Request::getClientIp(),
					'user-agent' => Request::header('user-agent')
				];
				if ($route = Typo::getRoute(Request::segment(1))) {
					Log::notice('typo-hits', $context);
					return Redirect::route($route);
				}
				Log::warning('404', $context);
				return Response::view('site.404', [], 404);

			} elseif ($e instanceof ToolsException) {
				Log::error($e);
				return Response::view('site.error', ['error' => $e->getMessage()], 500);
			}

			Log::error($e);
		} catch (Exception $e) {
			Log::error($e);
		}
		return Response::view('site.error', compact('error'), 500);
	}

}
