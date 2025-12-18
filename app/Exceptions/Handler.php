<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
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
        // the server upload limits (php.ini `upload_max_filesize` / `post_max_size`, nginx `client_max_body_size`,
        // Apache `LimitRequestBody`). This handler only catches exceptions that reach Laravel.
        $this->renderable(function (Throwable $e, $request) {
            // Laravel throws Illuminate\Http\Exceptions\PostTooLargeException when PHP post size is exceeded.
            // Additionally, some Http exceptions implement HttpExceptionInterface and may have a 413 status.
            $isTooLarge = false;

            if ($e instanceof PostTooLargeException) {
                $isTooLarge = true;
            }

            if (!$isTooLarge && $e instanceof HttpExceptionInterface) {
                try {
                    $isTooLarge = ($e->getStatusCode() === 413);
                } catch (\Throwable $ex) {
                    $isTooLarge = false;
                }
            }

            if ($isTooLarge) {
                // Use a validation-like message consistent with the admin UI (we set controller limit to 10MB)
                $message = 'Uploaded file is too large. Maximum allowed size is 10 MB.';

                // Log the occurrence so we can determine whether the request reached Laravel
                try {
                    \Illuminate\Support\Facades\Log::warning('Request entity too large reached Laravel', [
                        'ip' => $request->ip(),
                        'url' => $request->fullUrl(),
                        'content_length' => $request->header('content-length'),
                        'exception' => get_class($e),
                    ]);
                } catch (\Throwable $logEx) {
                    // ignore logging failures
                }

                // For AJAX/JSON requests, return a validation-style JSON response (422) with errors array
                if ($request->expectsJson() || $request->isJson()) {
                    return response()->json([
                        'message' => 'The given data was invalid.',
                        'errors' => ['image' => [$message]]
                    ], 422);
                }

                // For normal form requests, redirect back with a validation-like error on the 'image' field
                return redirect()->back()
                    ->withErrors(['image' => $message])
                    ->withInput();
            }
        });
    }
}
