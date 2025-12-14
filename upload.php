<?php
require 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

require 'vendor/autoload.php';

use Google\Client;
use Google\Service\Drive;

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {

    if ($_FILES['file']['size'] > MAX_UPLOAD_SIZE) {
        $message = "❌ File too large (Max 1GB)";
    } else {

        $client = new Client();
        $client->setAuthConfig(GOOGLE_CREDENTIALS_PATH);
        $client->addScope(Drive::DRIVE);

        $service = new Drive($client);

        $fileMetadata = new Drive\DriveFile([
            'name' => $_FILES['file']['name'],
            'parents' => [DRIVE_FOLDER_ID]
        ]);

        $content = file_get_contents($_FILES['file']['tmp_name']);

        $service->files->create(
            $fileMetadata,
            [
                'data' => $content,
                'uploadType' => 'multipart',
                'supportsAllDrives' => true
            ]
        );

        $message = "✅ Upload successful";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Upload File</title>
<style>
body { font-family: Arial; background:#f4f6f8; }
.box {
    width:400px; margin:100px auto; padding:20px;
    background:#fff; box-shadow:0 0 10px #ccc;
}
input, button {
    width:100%; padding:10px; margin-top:10px;
}
button {
    background:#16a34a; color:#fff; border:none;
}
</style>
</head>
<body>

<div class="box">
<h3>Upload to Google Drive</h3>

<?php if ($message) echo "<p>$message</p>"; ?>

<form method="post" enctype="multipart/form-data">
<input type="file" name="file" required>
<button>Upload</button>
</form>

<br>
<a href="logout.php">Logout</a>
</div>

</body>
</html>