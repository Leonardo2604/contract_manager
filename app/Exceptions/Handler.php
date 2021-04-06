<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof UnprocessableEntityException) {
            $errors = [];

            foreach ($exception->getErrors() as $field => $messages) {
                foreach ($messages as $message) {
                    $errors[] = [
                        "name" => $field,
                        "reason" => $message,
                        "help_url" => "http://api.intellish.com.br/help/system#$field"
                    ];
                }
            }

            return response()->json([
                "type" => "http://api.intellish.com.br/help/response-structs#validation-error",
                "title" => $exception->getTitle(),
                "status" => $exception->getCode(),
                "invalid_params" => $errors
            ], $exception->getCode());
        } else if ($exception instanceof ApplicationException) {
            return response()->json([
                "type" => "http://api.intellish.com.br/help/response-structs#error",
                "title" => $exception->getTitle(),
                "details" => $exception->getMessage(),
                "status" => $exception->getCode(),
            ], $exception->getCode());
        }

        return parent::render($request, $exception);
    }
}
