<?php
require 'config.php';
require 'vendor/autoload.php';

if (empty($_SESSION['auth'])) {
    die('Unauthorized');
}

if (!isset($_FILES['file'])) {
    die('No file selected');
}

if ($_FILES['file']['size'] > MAX_SIZE) {
    die('File too large');
}

/* ===== LOAD GOOGLE CREDS FROM ENV ===== */
$encoded = getenv('GOOGLE_CREDENTIALS_JSON');
if (!$encoded) {
    die('Google credentials ENV missing');
}

$json = base64_decode($encoded);
if (!$json) {
    die('Failed to decode credentials');
}

$tempFile = sys_get_temp_dir() . '/gdrive_creds.json';
file_put_contents($tempFile, $json);

/* ===== GOOGLE CLIENT ===== */
$client = new Google_Client();
$client->setAuthConfig($tempFile);
$client->addScope(Google_Service_Drive::DRIVE);

$service = new Google_Service_Drive($client);

/* ===== UPLOAD ===== */
$fileName = time() . '_' . basename($_FILES['file']['name']);

$fileMetadata = new Google_Service_Drive_DriveFile([
    'name' => $fileName,
    'parents' => [DRIVE_FOLDER_ID]
]);

$content = file_get_contents($_FILES['file']['tmp_name']);

$service->files->create($fileMetadata, [
    'data' => $content,
    'uploadType' => 'multipart'
]);

echo "<script>alert('✅ Upload successful');location='dashboard.php';</script>";