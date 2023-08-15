<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class Authenticate extends Controller
{
    public function handle(Request $request, Closure $next)
    {
        /**
         * validate middle
         */
        $user = Session::get(SESSION_JAVA_ACCOUNT);
        if (!isset($user['id'])) {
            return redirect('/login', 302, [], env('IS_DEPLOY_ON_SERVER'));
        }
        Session::put(SESSION_KEY_CURRENT_PATH, '/' . request()->path());
        $this->buildVersionDashboard();
        return $next($request);
    }

    public function buildVersionDashboard()
    {
        if (Session::get(SESSION_KEY_VERSION_DASHBOARD) !== Config::get('constants.version.VERSION_DASHBOARD') . '.' . Config::get('constants.version.MONTH') . '.' . Config::get('constants.version.VERSION_UPDATE')) {
            Session::put(SESSION_KEY_VERSION_DASHBOARD, Config::get('constants.version.VERSION_DASHBOARD') . '.' . Config::get('constants.version.MONTH') . '.' . Config::get('constants.version.VERSION_UPDATE'));
            View::share('auth_version_dashboard', Config::get('constants.version.VERSION_DASHBOARD') . '.' . Config::get('constants.version.MONTH') . '.' . Config::get('constants.version.VERSION_UPDATE'));
            View::share('auth_content_dashboard', Config::get('constants.version.CONTENT'));
            View::share('auth_important_dashboard', Config::get('constants.version.IMPORTANT'));
            View::share('update_version_dashboard', '1');
        } else {
            View::share('auth_version_dashboard', Config::get('constants.version.VERSION_DASHBOARD') . '.' . Config::get('constants.version.MONTH') . '.' . Config::get('constants.version.VERSION_UPDATE'));
            View::share('auth_content_dashboard', Config::get('constants.version.CONTENT'));
            View::share('auth_important_dashboard', Config::get('constants.version.IMPORTANT'));
            View::share('update_version_dashboard', '0');
        }
    }
}
