<?php

namespace App\Http\Middleware;

use Closure;

class CheckWorkingLibrary
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $libraryIdExists = session()->exists('working_library_id');
        $libraryNameExists = session()->exists('working_library_name');

        if ($libraryIdExists && $libraryNameExists) {
            return $next($request);
        } else {
            return redirect()
                ->route('librarian.panel')
                ->with(['not_found' => 'Спочатку треба обрати вашу робочу бібліотеку.']);
        }
    }
}
