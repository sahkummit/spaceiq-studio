<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// We are booted in Laravel!

$sourceDir = public_path('img/portfolio/2d-drafting');
$destDir = storage_path('app/public/services');

if (!file_exists($destDir)) {
    mkdir($destDir, 0775, true);
}

echo "<h1>Seeding AutoCAD Drafting (2D Drafting) Gallery</h1>";

if (!file_exists($sourceDir)) {
    die("Error: Source directory {$sourceDir} does not exist.");
}

$files = glob($sourceDir . '/*.jpg');
if (empty($files)) {
    die("Error: No images found in {$sourceDir}");
}

$serviceId = 6; // AutoCAD Drafting

// Delete existing media for this service to avoid duplicates
\App\Models\Media::where('service_id', $serviceId)->delete();

$count = 0;
foreach ($files as $index => $file) {
    $filename = basename($file);
    $destPath = $destDir . '/' . $filename;
    
    // Copy file to storage
    copy($file, $destPath);
    @chmod($destPath, 0664);
    
    $media = new \App\Models\Media();
    $media->title = "2D Drafting - Draft " . ($index + 1);
    $media->alt_text = "AutoCAD Drafting - Detail " . ($index + 1);
    $media->file_path = "services/" . $filename;
    $media->source = "upload";
    $media->file_type = "image";
    $media->service_id = $serviceId;
    $media->category = "";
    $media->sort_order = $index + 1;
    $media->save();
    
    echo "<p>Copied and registered: {$filename} as Media ID {$media->id}</p>";
    $count++;
}

echo "<h2>Success! {$count} draft images registered under AutoCAD Drafting.</h2>";
echo "<p><a href='/services/autocad-drafting'>Go to AutoCAD Drafting Gallery</a></p>";
