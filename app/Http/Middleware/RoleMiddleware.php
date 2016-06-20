<?php

namespace accesorfid\Http\Middleware;

use Closure;

class RoleMiddleware
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

        if ($request->user()->usu_tusuario_id != 1) {
            return redirect('controlaccc');
        }

        return $next($request);
    }
}
