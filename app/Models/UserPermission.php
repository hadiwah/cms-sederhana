<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;

    protected $fillable = ['role', 'route_name'];

    //the list of the route when authenticated
    public static function routeNameList()
    {
        return [
            'dashboard',
            'pages',
            'members',
            'navigation-menus',
            'users',
            'user-permissions', 
        ];
    }

    //checks if the current user role has access
    public static function isRoleHasRightToAccess($userRole, $routeName)
    {
        try {
            //code...
            $model = static::where('role', $userRole)
                ->where('route_name', $routeName)
                ->first();

                return $model ? true : false;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }
}
