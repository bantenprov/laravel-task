<?php namespace Bantenprov\Task\Http\Middleware;

use Closure;

/**
 * The TaskMiddleware class.
 *
 * @package Bantenprov\Task
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class TaskMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
