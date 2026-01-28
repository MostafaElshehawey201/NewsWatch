<?php

namespace App\Exceptions;

use Throwable;
use DomainException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $e)
    {
        if ($e instanceof DomainException) {
            return response()->json([
                'success' => false,
                'data' => null,
                'errors' => [
                    "message" => $e->getMessage(),
                    "line" => $e->getLine(),
                    "file" => $e->getFile(),
                ],
            ], 400);
        }

        return parent::render($request, $e);
    }
}
