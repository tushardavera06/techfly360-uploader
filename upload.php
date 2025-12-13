<?php
require 'config.php';
require 'vendor/autoload.php';

if (empty($_SESSION['auth'])) die('Unauthorized');
if (!isset($_FILES['file'])) die('No file');

if ($_FILES['file']['size'] > MAX_SIZE) die('File too large');

$client = new Google_Client();
$client->setAuthConfig('credentials.json');
$client->addScope(Google_Service_Drive::DRIVE);

$service = new Google_Service_Drive($client);

$name = time().'_'.basename($_FILES['file']['name']);
$fileMeta = new Google_Service_Drive_DriveFile([
  'name'=>$name,
  'parents'=>[DRIVE_FOLDER_ID]
]);

$content = file_get_contents($_FILES['file']['tmp_name']);
$service->files->create($fileMeta,[
  'data'=>$content,
  'uploadType'=>'multipart'
]);

echo "<script>alert('✅ Upload Successful');location='dashboard.php';</script>";