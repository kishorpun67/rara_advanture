<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $roles = [
            'admin'=>[2],
            'meister'=>[1,2],
            'manager'=>[1,3],
            'user'=>[1,4],
        ];
        // $rolesids = $roles[$role] ?? '';
    
        if(!in_array(auth('admin')->user()->role_id, $roles[$role])){
            return redirect('/admin/dashboard' )->with('error_message', 'You are not allowed');
        }
        return $next($request);
    }
}
