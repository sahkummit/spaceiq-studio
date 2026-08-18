<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// We are booted in Laravel!

$sourceDir = public_path();
$destDir = storage_path('app/public/services');

if (!file_exists($destDir)) {
    mkdir($destDir, 0775, true);
}

echo "<h1>Seeding AutoCAD Drafting (2D Drafting) Gallery with PDFs</h1>";

$files = glob($sourceDir . '/media_178703590*.pdf');
if (empty($files)) {
    die("Error: No user PDF files found in public directory.");
}

$serviceId = 6; // AutoCAD Drafting

// Delete existing media for this service to avoid duplicates
\App\Models\Media::where('service_id', $serviceId)->delete();

$count = 0;
// Titles to make it look professional
$titles = [
    1 => "Site Plan Drawing (Existing vs Proposed)",
    2 => "Landscape Layout Detail",
    3 => "Floor Plan & Demolition Layout",
    4 => "Floor Plan Details & Room Legend"
];

foreach ($files as $index => $file) {
    $filename = basename($file);
    $destPath = $destDir . '/' . $filename;
    
    // Copy file to storage
    copy($file, $destPath);
    @chmod($destPath, 0664);
    
    $media = new \App\Models\Media();
    $media->title = $titles[$index + 1] ?? "2D Drafting Plan " . ($index + 1);
    $media->alt_text = "AutoCAD Drafting PDF Plan - Detail " . ($index + 1);
    $media->file_path = "services/" . $filename;
    $media->source = "upload";
    $media->file_type = "pdf"; // Set file_type to pdf!
    $media->service_id = $serviceId;
    $media->category = "";
    $media->sort_order = $index + 1;
    $media->save();
    
    echo "<p>Copied and registered PDF: {$filename} as Media ID {$media->id} with type 'pdf'</p>";
    $count++;
}

echo "<h2>Success! {$count} PDF documents registered under AutoCAD Drafting.</h2>";
echo "<p><a href='/services/autocad-drafting'>Go to AutoCAD Drafting Gallery</a></p>";
