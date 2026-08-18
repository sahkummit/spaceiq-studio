<?php

// Allow execution for up to 10 minutes
ini_set('max_execution_time', 600);

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// We are booted in Laravel locally!

$outputDir = storage_path('app/public/services');
if (!file_exists($outputDir)) {
    mkdir($outputDir, 0775, true);
}

echo "<h1>Syncing 2D Drafting Media from Production to Localhost</h1>";

$jsonUrl = "https://spaceiqstudio.com/split.php?format=json";
echo "<p>Fetching media list from: {$jsonUrl}</p>";

$jsonContent = @file_get_contents($jsonUrl);
if ($jsonContent === false) {
    die("<h2>Error: Could not retrieve media list from production server. Make sure you ran Step 1 and Step 2 on the server first.</h2>");
}

$mediaItems = json_decode($jsonContent, true);
if (!is_array($mediaItems) || empty($mediaItems)) {
    die("<h2>Error: Retrieved media list is empty. Make sure you visited https://spaceiqstudio.com/split.php to generate images.</h2>");
}

echo "<p>Found " . count($mediaItems) . " media items on production server. Starting download and database sync...</p>";

$serviceId = 6; // AutoCAD Drafting

// Delete local media for this service to avoid duplicates
\App\Models\Media::where('service_id', $serviceId)->delete();

$downloadedCount = 0;
$dbCount = 0;

foreach ($mediaItems as $item) {
    $filePath = $item['file_path'];
    $filename = basename($filePath);
    $localPath = $outputDir . '/' . $filename;
    
    // Download file if it doesn't exist
    if (!file_exists($localPath)) {
        $remoteFileUrl = "https://spaceiqstudio.com/storage/" . $filePath;
        echo "<p>Downloading: {$remoteFileUrl} -> {$localPath} ... ";
        
        $fileData = @file_get_contents($remoteFileUrl);
        if ($fileData !== false) {
            file_put_contents($localPath, $fileData);
            echo "<span style='color:green;'>SUCCESS</span></p>";
            $downloadedCount++;
        } else {
            echo "<span style='color:red;'>FAILED</span></p>";
            continue;
        }
    } else {
        echo "<p>File already exists locally: {$filename}</p>";
    }
    
    // Insert into local database
    $media = new \App\Models\Media();
    $media->title = $item['title'];
    $media->alt_text = $item['alt_text'];
    $media->file_path = $filePath;
    $media->source = $item['source'];
    $media->file_type = $item['file_type'];
    $media->service_id = $serviceId;
    $media->category = $item['category'];
    $media->sort_order = $item['sort_order'];
    $media->save();
    
    $dbCount++;
}

echo "<h2>Sync Complete!</h2>";
echo "<p>Downloaded {$downloadedCount} new images.</p>";
echo "<p>Registered {$dbCount} items in local database.</p>";
echo "<p><a href='/services/autocad-drafting'>Go to local AutoCAD Drafting Gallery</a></p>";
