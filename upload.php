<?php
require_once 'config.php';

// 🔐 Login protection
if (!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit;
}

// Google Client
require_once __DIR__ . '/vendor/autoload.php';

$client = new Google_Client();
$client->setAuthConfig(GOOGLE_CREDENTIALS_PATH);
$client->addScope(Google_Service_Drive::DRIVE);

$service = new Google_Service_Drive($client);

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {

    if ($_FILES['file']['size'] > MAX_UPLOAD_SIZE) {
        $message = "❌ File too large (Max 1GB)";
    } else {

        $fileMetadata = new Google_Service_Drive_DriveFile([
            'name' => $_FILES['file']['name'],
            'parents' => [DRIVE_FOLDER_ID]
        ]);

        $content = file_get_contents($_FILES['file']['tmp_name']);

        $service->files->create(
            $fileMetadata,
            [
                'data' => $content,
                'mimeType' => $_FILES['file']['type'],
                'uploadType' => 'multipart'
            ]
        );

        $message = "✅ File uploaded successfully to Google Drive";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title>
    <style>
        body {
            font-family: Arial;
            background: #eef1ff;
        }
        .box {
            width: 350px;
            margin: 120px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        input, button {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
        }
        button {
            background: #4f6bed;
            color: white;
            border: none;
        }
        .msg {
            margin-bottom: 10px;
            color: green;
        }
        .logout {
            margin-top: 15px;
            display: block;
        }
    </style>
</head>
<body>

<div class="box">
    <h3>Upload File</h3>

    <?php if ($message): ?>
        <div class="msg"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Upload to Drive</button>
    </form>

    <a class="logout" href="logout.php">Logout</a>
</div>

</body>
</html>