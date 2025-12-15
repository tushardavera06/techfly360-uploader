<?php
require 'config.php';

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {

    if ($_FILES['file']['size'] > MAX_UPLOAD_SIZE) {
        $message = "❌ File too large";
    } else {

        $filePath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'chat_id' => CHANNEL_ID,
                'document' => new CURLFile($filePath, mime_content_type($filePath), $fileName)
            ]
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        if ($response) {
            $message = "✅ File uploaded to Telegram";
        } else {
            $message = "❌ Upload failed";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="upload-box">
    <h2>Upload File</h2>

    <?php if ($message): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>

    <br>
    <a href="logout.php">Logout</a>
</div>

</body>
</html>