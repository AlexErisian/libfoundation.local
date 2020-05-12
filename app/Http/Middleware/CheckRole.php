<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $userRole = $request->user()->role->name;
        if ($userRole === $role || $userRole === 'admin') {
            return $next($request);
        } else {
            return back()->with([
                    'role_rejection' => 'На жаль, у вас немає права на здійснення даного запиту.'
                ]);
        }
    }
}
