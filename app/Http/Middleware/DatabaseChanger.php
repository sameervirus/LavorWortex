<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class DatabaseChanger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($request->getHost()) {
            case 'www.lavor-egypt.com':
                config([
                    'app.url' => 'https://www.lavor-egypt.com',
                    'database.default' => 'mysql',
                    'medialibrary.disk_name' => 'uploads',
                    'analytics.view_id' => '154353990',
                ]);
                break;

            case 'www.wortex-egypt.com':
                config([
                    'app.url' => 'https://www.wortex-egypt.com',
                    'database.default' => 'mysql2',
                    'medialibrary.disk_name' => 'media',
                    'analytics.view_id' => '154353990',
                ]);
                break;

            default:
                abort(403, $request->getHost());
        }

        return $next($request);
    }
}