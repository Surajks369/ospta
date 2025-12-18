<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckUploadSize
{
    /**
     * Handle an incoming request.
     * If Content-Length header indicates a size larger than allowed, return a validation-like response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $maxMb = (int) config('gallery.max_upload_mb', 10);
        $maxBytes = $maxMb * 1024 * 1024;

        // Content-Length header may be present; use it as a quick pre-check.
        $contentLength = 0;
        if ($request->headers->has('content-length')) {
            $contentLength = (int) $request->header('content-length');
        } elseif (isset($_SERVER['CONTENT_LENGTH'])) {
            $contentLength = (int) $_SERVER['CONTENT_LENGTH'];
        }

        if ($contentLength > 0 && $contentLength > $maxBytes) {
            $message = "Uploaded file is too large. Maximum allowed size is {$maxMb} MB.";

            // Log for debugging so we can see whether the request reached Laravel
            Log::warning('Upload blocked by CheckUploadSize middleware', [
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
                'content_length' => $contentLength,
                'max_bytes' => $maxBytes,
            ]);

            if ($request->expectsJson() || $request->isJson()) {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => ['image' => [$message]]
                ], 422);
            }

            return redirect()->back()->withErrors(['image' => $message])->withInput();
        }

        return $next($request);
    }
}
