<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    private $allowed_types = ['supaBoss'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!in_array($request->user()->type, $this->allowed_types))
        {
            abort(403, 'Access denied');
        }
        return $next($request);
    }
}
