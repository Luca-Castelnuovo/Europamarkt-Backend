<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * Render an exception into an HTTP response.
     *
     * @param Request   $request
     * @param Exception $exception
     *
     * @return JsonResponse|Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof NotFoundHttpException || $exception instanceof MethodNotAllowedHttpException) {
            return response()->json(
                ['error' => 'endpoint not found'],
                404
            );
        }

        return parent::render($request, $exception);
    }
}
