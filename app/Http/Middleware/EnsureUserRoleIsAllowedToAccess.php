<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\UserPermission;

class EnsureUserRoleIsAllowedToAccess
{
    /** dashboard, pages, navigation-menu
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            //code...
            $userRole = auth()->user()->role;
            $currentRouteName = Route::currentRouteName();

            if ( UserPermission::isRoleHasRightToAccess($userRole, $currentRouteName)
                || in_array($currentRouteName, $this->defaultUserAccessRole()[$userRole])){
                return $next($request); 
            } else {
                abort(403, 'Unauthorized action.');
            }
        } catch (\Throwable $th) {
            //throw $th;
            abort(403, 'Unauthorized action.');
        }
    }

    //the default user access role
    private function defaultUserAccessRole()
    {
        return [
            'admin' => [
                'user-permissions',
            ],
        ];
    }
}
