<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            if ($exception instanceof ModelNotFoundException) {
                return response()->json(['error' => 'Resource not found'], 404);
            }
            if ($exception instanceof ValidationException) {
                return response()->json(['errors' => $exception->validator->errors()->all()], 422);
            }
            if ($exception instanceof AuthenticationException) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }
            if ($exception instanceof AuthorizationException) {
                return response()->json(['error' => 'This action is unauthorized.'], 403);
            }
            if ($exception instanceof MethodNotAllowedHttpException) {
                return response()->json(['error' => 'The specified method for the request is invalid.'], 405);
            }
            if ($exception instanceof NotFoundHttpException) {
                return response()->json(['error' => 'The specified URL cannot be found.'], 404);
            }
            if ($exception instanceof ThrottleRequestsException) {
                return response()->json(['error' => 'Too Many Attempts.'], 429);
            }

            return response()->json(['error' => 'An error occurred.'], 500);
        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        return redirect()->guest($exception->redirectTo() ?? route('login'));
    }
}
