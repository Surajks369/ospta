<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // Render a user-friendly validation-like error when the request entity is too large (HTTP 413).
        // Note: if your front web server (nginx/apache) returns 413 before PHP runs, you must increase
        // the server upload limits (see README instructions). This handler only catches exceptions
        // that reach Laravel.
        $this->renderable(function (Throwable $e, $request) {
            // Some exceptions provide getStatusCode(), others are HttpException instances
            $status = null;
            if (method_exists($e, 'getStatusCode')) {
                try {
                    $status = $e->getStatusCode();
                } catch (\Throwable $ex) {
                    $status = null;
                }
            }

            if ($status === 413) {
                // If this is an AJAX/JSON request, return JSON; otherwise redirect back with a validation error
                $message = 'Uploaded file is too large. Maximum allowed size is 2 MB.';
                if ($request->expectsJson() || $request->isJson()) {
                    return response()->json(['message' => $message], 413);
                }

                // Redirect back with validation-like error on the 'image' field
                return redirect()->back()
                    ->withErrors(['image' => $message])
                    ->withInput();
            }
        });
    }
}
