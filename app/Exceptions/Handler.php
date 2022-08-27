<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    public function render($request, Throwable $e)
    {
        if ($e instanceof AuthenticationException) {

            if ($request->expectsJson()) {
                return response()->json(
                    [
                        'type' => 'error',
                        'status' => Response::HTTP_UNAUTHORIZED,
                        'message' => 'Access Token expires',
                    ],
                    Response::HTTP_UNAUTHORIZED
                );
            } else {
                return redirect('/login');
            }
        }

        return parent::render($request, $e);
    }
}
