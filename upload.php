<?php
require 'config.php';
if (!isset($_SESSION['logged_in'])) exit;

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_FILES['file']['size'] > MAX_UPLOAD_SIZE) {
        $msg = "File too large";
    } else {

        $customName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $_POST['title']);
        $tmp = $_FILES['file']['tmp_name'];
        $zipPath = sys_get_temp_dir() . "/$customName.zip";

        $zip = new ZipArchive();
        $zip->open($zipPath, ZipArchive::CREATE);
        $zip->addFile($tmp, $_FILES['file']['name']);
        $zip->close();

        $zipSize = filesize($zipPath);

        $ch = curl_init("https://api.telegram.org/bot".TELEGRAM_BOT_TOKEN."/sendDocument");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'chat_id' => TELEGRAM_CHAT_ID,
            'document' => new CURLFile($zipPath)
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);

        $res = json_decode($res, true);
        $fileId = $res['result']['document']['file_id'];

        $history = json_decode(file_get_contents(HISTORY_FILE), true);
        $history[] = [
            'name' => $customName,
            'zip_size' => $zipSize,
            'date' => date('Y-m-d H:i'),
            'telegram_link' => "https://t.me/c/".substr(TELEGRAM_CHAT_ID,4)
        ];
        file_put_contents(HISTORY_FILE, json_encode($history, JSON_PRETTY_PRINT));

        $msg = "✅ Uploaded to Telegram";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Upload</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
<h2>Upload File (Auto ZIP)</h2>
<form method="post" enctype="multipart/form-data">
<input name="title" placeholder="ZIP Name" required>
<input type="file" name="file" required>
<button>Upload</button>
</form>
<p><?= $msg ?></p>
<a href="dashboard.php">Back</a>
</div>
</body>
</html>