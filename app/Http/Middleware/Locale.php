<?php

namespace App\Http\Middleware;

use App;
use Cookie;
use Closure;

class Locale
{
    private $languages = ['en', 'zh'];

    public function handle($request, Closure $next)
    {
        if (Cookie::has('locale') && in_array(Cookie::get('locale'), $this->languages)) {
            $locale = Cookie::get('locale');
        } else {
            $locale = $request->getPreferredLanguage($this->languages);
        }

        App::setLocale($locale);

        return $next($request);
    }
}
