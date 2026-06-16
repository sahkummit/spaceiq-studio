<?php

if (!function_exists('webp_asset')) {
    /**
     * Return the asset URL, preferring a .webp version if it exists.
     * Falls back to the original if no WebP version is present.
     *
     * @param  string  $path  Path relative to public directory (e.g. 'img/hero_bg.jpg')
     * @return string
     */
    function webp_asset(string $path): string
    {
        $webpPath = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $path);

        // Check public path first
        if (file_exists(public_path($webpPath))) {
            return asset($webpPath);
        }

        // Check storage/app/public path (accessed via storage symlink)
        $storagePath = str_replace('storage/', '', $webpPath);
        if (file_exists(storage_path('app/public/' . $storagePath))) {
            return asset($webpPath);
        }

        return asset($path);
    }
}

if (!function_exists('picture_tag')) {
    /**
     * Generate a <picture> element that serves WebP to supporting browsers
     * with a JPG/PNG fallback for older ones.
     *
     * @param  string  $path    Asset path (e.g. 'img/hero_bg.jpg')
     * @param  string  $alt     Alt text
     * @param  string  $class   CSS classes for the <img> tag
     * @param  string  $extras  Extra attributes for the <img> tag
     * @return string
     */
    function picture_tag(string $path, string $alt = '', string $class = '', string $extras = ''): string
    {
        $webpPath = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $path);
        $webpUrl = '';

        if (file_exists(public_path($webpPath))) {
            $webpUrl = asset($webpPath);
        }

        $originalUrl = asset($path);

        if ($webpUrl) {
            return sprintf(
                '<picture><source srcset="%s" type="image/webp"><img src="%s" alt="%s" class="%s" %s></picture>',
                htmlspecialchars($webpUrl),
                htmlspecialchars($originalUrl),
                htmlspecialchars($alt),
                htmlspecialchars($class),
                $extras
            );
        }

        return sprintf(
            '<img src="%s" alt="%s" class="%s" %s>',
            htmlspecialchars($originalUrl),
            htmlspecialchars($alt),
            htmlspecialchars($class),
            $extras
        );
    }
}
