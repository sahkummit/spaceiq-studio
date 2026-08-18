<?php

// Allow execution for up to 10 minutes
ini_set('max_execution_time', 600);

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// We are booted in Laravel!

$serviceId = 6; // AutoCAD Drafting

// If format=json is requested, return the media entries
if ($request->query('format') === 'json') {
    $media = \App\Models\Media::where('service_id', $serviceId)->orderBy('sort_order')->get();
    header('Content-Type: application/json');
    echo json_encode($media);
    exit;
}

$outputDir = storage_path('app/public/services');
if (!file_exists($outputDir)) {
    mkdir($outputDir, 0775, true);
}

// Find all PDF files in public directory
$pdfFiles = glob(public_path('*.pdf'));

echo "<h1>Starting PDF Splitting Process</h1>";
echo "<p>Found " . count($pdfFiles) . " PDF files to process.</p>";

// Delete existing media for this service to avoid duplicates
\App\Models\Media::where('service_id', $serviceId)->delete();

$totalCount = 0;
$globalIndex = 1;

foreach ($pdfFiles as $pdfPath) {
    $pdfName = basename($pdfPath);
    echo "<h3>Processing: {$pdfName}</h3>";
    
    $output = [];
    $returnVar = -1;
    
    // Unique prefix for this PDF's pages
    $safeBaseName = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($pdfName, PATHINFO_FILENAME));
    $outputPrefix = $outputDir . '/' . $safeBaseName . '-page';
    
    // 1. Try pdftoppm
    echo "<p>Attempting pdftoppm...</p>";
    $cmd = "pdftoppm -png -r 150 " . escapeshellarg($pdfPath) . " " . escapeshellarg($outputPrefix) . " 2>&1";
    exec($cmd, $output, $returnVar);
    
    // 2. Fallback to Ghostscript
    if ($returnVar !== 0) {
        echo "<p>pdftoppm failed (code {$returnVar}). Attempting Ghostscript...</p>";
        $output = [];
        $outputPrefixGs = $outputDir . '/' . $safeBaseName . '-page-%d.png';
        $cmd = "gs -dNOPAUSE -sDEVICE=png16m -r150 -sOutputFile=" . escapeshellarg($outputPrefixGs) . " " . escapeshellarg($pdfPath) . " -c quit 2>&1";
        exec($cmd, $output, $returnVar);
    }
    
    // 3. Fallback to ImageMagick
    if ($returnVar !== 0) {
        echo "<p>Ghostscript failed (code {$returnVar}). Attempting ImageMagick...</p>";
        $output = [];
        $outputPrefixIm = $outputDir . '/' . $safeBaseName . '-page-%d.png';
        $cmd = "convert -density 150 " . escapeshellarg($pdfPath) . " " . escapeshellarg($outputPrefixIm) . " 2>&1";
        exec($cmd, $output, $returnVar);
    }
    
    if ($returnVar !== 0) {
        echo "<h4 style='color:red;'>Error: Failed to convert {$pdfName}. Log:</h4>";
        echo "<pre>" . implode("\n", $output) . "</pre>";
        continue;
    }
    
    // Scan for generated images for this PDF
    $generatedFiles = glob($outputDir . '/' . $safeBaseName . '-page-*.png');
    natsort($generatedFiles);
    
    $pdfPageCount = 0;
    foreach ($generatedFiles as $file) {
        $filename = basename($file);
        
        // Parse page number
        preg_match('/-page-(\d+)\.png/', $filename, $matches);
        $pageNumber = isset($matches[1]) ? (int)$matches[1] : 0;
        
        $media = new \App\Models\Media();
        $media->title = "2D Drafting - " . pathinfo($pdfName, PATHINFO_FILENAME) . " - Page " . $pageNumber;
        $media->alt_text = "AutoCAD Drafting Page " . $pageNumber;
        $media->file_path = "services/" . $filename;
        $media->source = "upload";
        $media->file_type = "image";
        $media->service_id = $serviceId;
        $media->category = "";
        $media->sort_order = $globalIndex;
        $media->save();
        
        echo "<p>Registered: {$filename} (Page {$pageNumber}) as Media ID {$media->id}</p>";
        $pdfPageCount++;
        $globalIndex++;
        $totalCount++;
    }
    
    echo "<p style='color:green;'>Success: Converted {$pdfPageCount} pages from {$pdfName}.</p>";
}

echo "<h2>Done! Total {$totalCount} pages registered under AutoCAD Drafting.</h2>";
echo "<p><a href='/services/autocad-drafting'>Go to AutoCAD Drafting Gallery</a></p>";
