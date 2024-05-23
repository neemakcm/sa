<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use SiteHelper;
use Auth;

class CheckPermission
{
    /**
     * For checking user permission
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next ,$permission = null,$guard="admin")
    {
        if (!SiteHelper::can($permission) ) {

             if ($request->ajax()) { 
                return response([
                    'error' => 'Forbidden',
                    'error_description' => 'Permission denied.',
                    'data' => [],
                ], 403);
            } else {

                return redirect('/admin/forbidden');
            }
        }
        return $next($request);
    }
}
