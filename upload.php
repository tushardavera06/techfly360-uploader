<?php
require 'config.php';
if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $file = $_FILES['file'];

    if ($file['size'] > MAX_UPLOAD_SIZE) {
        $message = 'File too large';
    } else {
        $zipName = TEMP_DIR . '/' . time() . '.zip';
        $zip = new ZipArchive();
        $zip->open($zipName, ZipArchive::CREATE);
        $zip->addFile($file['tmp_name'], $file['name']);
        $zip->close();

        $zipSize = filesize($zipName);

        // Telegram upload
        $ch = curl_init("https://api.telegram.org/bot".BOT_TOKEN."/sendDocument");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'chat_id' => CHANNEL_ID,
            'document' => new CURLFile($zipName),
            'caption' => $title
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = json_decode(curl_exec($ch), true);
        curl_close($ch);

        unlink($zipName);

        if ($res['ok']) {
            $entry = [
                'title' => $title,
                'zip_size' => $zipSize,
                'date' => date('d M Y H:i'),
                'telegram_link' => "https://t.me/c/".str_replace('-100','',CHANNEL_ID)."/".$res['result']['message_id']
            ];
            $old = file_exists(DATA_FILE) ? json_decode(file_get_contents(DATA_FILE), true) : [];
            $old[] = $entry;
            file_put_contents(DATA_FILE, json_encode($old, JSON_PRETTY_PRINT));
            $message = 'File uploaded successfully';
        } else {
            $message = 'Telegram upload failed';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Upload</title>
</head>
<body>

<div class="card">
<h2>Upload File (Auto ZIP)</h2>
<?php if($message): ?><p class="success"><?= $message ?></p><?php endif; ?>

<form method="post" enctype="multipart/form-data">
<input name="title" placeholder="File name / title" required>
<input type="file" name="file" required>
<button>Upload</button>
</form>

<a href="dashboard.php">⬅ Back</a>
</div>

</body>
</html>