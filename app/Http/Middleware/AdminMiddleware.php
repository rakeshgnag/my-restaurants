<?php

namespace App\Http\Middleware;

use Closure;
use ErrorType;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = '')
    {
        $user = $request->user();
        
        if ($user->type == 'user') {
            return response()->json([
                'ok' => false,
                'error' => 'no_permission',
                'stuff' => 'Unauthorized access reason you are not a admin'
            ], 403);
        }
        return $next($request);
    }
}
