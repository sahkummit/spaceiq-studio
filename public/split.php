<?php

// Allow execution for up to 5 minutes
ini_set('max_execution_time', 300);

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// We are now booted into Laravel!

$pdfPath = public_path('temp_pdf.pdf');
$outputDir = storage_path('app/public/services');

if (!file_exists($pdfPath)) {
    die("Error: temp_pdf.pdf not found in public folder. Please upload it first.");
}

if (!file_exists($outputDir)) {
    mkdir($outputDir, 0775, true);
}

echo "<h1>Starting PDF Splitting Process</h1>";
echo "<p>PDF Path: {$pdfPath}</p>";
echo "<p>Output Directory: {$outputDir}</p>";

$output = [];
$returnVar = -1;

// 1. Try pdftoppm (Fastest and highest quality)
echo "<p>Attempting pdftoppm...</p>";
$outputPrefix = $outputDir . '/pdf_page';
$cmd = "pdftoppm -png -r 150 " . escapeshellarg($pdfPath) . " " . escapeshellarg($outputPrefix) . " 2>&1";
exec($cmd, $output, $returnVar);

// 2. Fallback to Ghostscript
if ($returnVar !== 0) {
    echo "<p>pdftoppm failed (code {$returnVar}). Attempting Ghostscript...</p>";
    $output = [];
    $outputPrefixGs = $outputDir . '/pdf_page-%d.png';
    $cmd = "gs -dNOPAUSE -sDEVICE=png16m -r150 -sOutputFile=" . escapeshellarg($outputPrefixGs) . " " . escapeshellarg($pdfPath) . " -c quit 2>&1";
    exec($cmd, $output, $returnVar);
}

// 3. Fallback to ImageMagick
if ($returnVar !== 0) {
    echo "<p>Ghostscript failed (code {$returnVar}). Attempting ImageMagick...</p>";
    $output = [];
    $outputPrefixIm = $outputDir . '/pdf_page-%d.png';
    $cmd = "convert -density 150 " . escapeshellarg($pdfPath) . " " . escapeshellarg($outputPrefixIm) . " 2>&1";
    exec($cmd, $output, $returnVar);
}

if ($returnVar !== 0) {
    echo "<h2>Error: All PDF conversion tools failed.</h2>";
    echo "<pre>" . implode("\n", $output) . "</pre>";
    exit;
}

echo "<p>PDF pages converted successfully!</p>";

// 4. Scan for generated images and insert into database
$files = glob($outputDir . '/pdf_page-*.png');
natsort($files); // Sort naturally (page-1, page-2, ..., page-14)

echo "<h2>Registering pages in database...</h2>";
$serviceId = 6; // AutoCAD Drafting

// Delete existing media for this service to avoid duplicates if rerun
\App\Models\Media::where('service_id', $serviceId)->delete();

$count = 0;
foreach ($files as $file) {
    $filename = basename($file);
    
    // Parse page number (e.g., pdf_page-1.png -> 1)
    preg_match('/pdf_page-(\d+)\.png/', $filename, $matches);
    $pageNumber = isset($matches[1]) ? (int)$matches[1] : 0;
    
    $media = new \App\Models\Media();
    $media->title = "2D Drafting - Page " . $pageNumber;
    $media->alt_text = "AutoCAD Drafting Page " . $pageNumber;
    $media->file_path = "services/" . $filename;
    $media->source = "upload";
    $media->file_type = "image";
    $media->service_id = $serviceId;
    $media->category = "";
    $media->sort_order = $pageNumber;
    $media->save();
    
    echo "<p>Registered: {$filename} (Page {$pageNumber}) as Media ID {$media->id}</p>";
    $count++;
}

echo "<h2>Success! {$count} pages registered under AutoCAD Drafting category.</h2>";
echo "<p><a href='/services/autocad-drafting'>Go to AutoCAD Drafting Gallery</a></p>";
