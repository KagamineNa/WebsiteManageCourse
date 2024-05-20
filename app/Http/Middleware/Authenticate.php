<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function unauthenticated($request, array $guards)
    {
        if ($request->is('admin') || $request->is('admin/*')) {
            throw new AuthenticationException(
                'Unauthenticated.',
                $guards,
                $this->redirectTo($request, !in_array('students', $guards))
            );
        }
    }

    protected function redirectTo($request, $isAdmin = true)
    {

        if (!$request->expectsJson()) {
            if (!$isAdmin) {
                return route('clients.login');
            }
            return route('login');
        }
    }
}
