<?php
require 'config.php';

if (!isset($_SESSION['login'])) {
    exit("Unauthorized");
}

if (!isset($_FILES['file'])) {
    exit("No file selected");
}

$file = $_FILES['file'];

if ($file['size'] > MAX_UPLOAD_SIZE) {
    exit("❌ File too large");
}

$tmpPath  = $file['tmp_name'];
$origName = $file['name'];

/* ZIP NAME */
$custom = trim($_POST['zip_name'] ?? '');

if ($custom !== '') {
    $safe = preg_replace('/[^a-zA-Z0-9_-]/', '_', $custom);
    $zipName = $safe . '.zip';
} else {
    $zipName = pathinfo($origName, PATHINFO_FILENAME) . '.zip';
}

$zipPath = sys_get_temp_dir() . '/' . $zipName;

/* CREATE ZIP */
$zip = new ZipArchive();
if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
    exit("❌ ZIP creation failed");
}
$zip->addFile($tmpPath, $origName);
$zip->close();

/* SEND TO TELEGRAM */
$ch = curl_init("https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument");

curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => [
        'chat_id' => CHANNEL_ID,
        'caption' => "📦 Auto ZIP Upload",
        'document' => new CURLFile($zipPath, 'application/zip', $zipName)
    ]
]);

$response = curl_exec($ch);
curl_close($ch);

/* CLEANUP */
@unlink($zipPath);

echo "✅ Upload completed (ZIP stored in Telegram)";