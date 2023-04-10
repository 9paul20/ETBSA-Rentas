<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthorizationException) {
            return response()->view('Front.Errors.403', [], 403);
        }

        if (
            $exception instanceof ModelNotFoundException ||
            $exception instanceof NotFoundHttpException
        ) {
            return response()->view('Front.Errors.404', [], 404);
        }
        // if ($exception instanceof HttpException) {
        //     $status = $exception->getStatusCode();
        //     if ($status === 403) {
        //         return response()->view('Front.Errors.403', [], $status);
        //     } elseif ($status === 404) {
        //         return response()->view('Front.Errors.404', [], $status);
        //     }
        // }

        return parent::render($request, $exception);
    }
}