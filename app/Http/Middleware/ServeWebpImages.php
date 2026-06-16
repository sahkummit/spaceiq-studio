<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Automatically serve .webp versions of images when:
 * 1. The browser supports WebP (Accept header contains "image/webp")
 * 2. A .webp version of the requested image exists
 *
 * This middleware intercepts requests to /storage/* image files
 * and transparently redirects to the .webp equivalent.
 */
class ServeWebpImages
{
    public function handle(Request $request, Closure $next): SymfonyResponse
    {
        $path = $request->path();

        // Only intercept image requests
        if (!preg_match('/\.(jpg|jpeg|png)$/i', $path)) {
            return $next($request);
        }

        // Check if browser supports WebP
        $accept = $request->header('Accept', '');
        if (!str_contains($accept, 'image/webp')) {
            return $next($request);
        }

        // Build the WebP path
        $webpPath = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $path);
        $webpFullPath = public_path($webpPath);

        // Check storage symlink path too
        if (!file_exists($webpFullPath)) {
            $storagePath = storage_path('app/public/' . str_replace('storage/', '', $webpPath));
            if (!file_exists($storagePath)) {
                return $next($request);
            }
        }

        // Redirect to the WebP version
        return redirect($request->root() . '/' . $webpPath, 302, [
            'Vary' => 'Accept',
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }
}
