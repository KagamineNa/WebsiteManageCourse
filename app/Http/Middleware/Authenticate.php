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
        } else {
            // Xử lý cho các trường hợp không phải admin
            throw new AuthenticationException(
                'Unauthenticated.',
                $guards,
                $this->redirectTo($request, false) // Giả sử mọi trường hợp khác không phải là admin
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
