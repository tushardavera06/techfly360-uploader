<?php
require 'config.php';
if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit;
}

$data = file_exists(DATA_FILE) ? json_decode(file_get_contents(DATA_FILE), true) : [];
$totalFiles = count($data);
$totalSize = array_sum(array_column($data, 'zip_size'));
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Dashboard</title>
</head>
<body>

<div class="card">
<h2>Advanced Dashboard</h2>

<div class="stats">
<div>📦 Files: <?= $totalFiles ?></div>
<div>💾 Size: <?= round($totalSize/1024/1024,2) ?> MB</div>
<div>🗜 Auto ZIP: <?= AUTO_ZIP ? 'ON' : 'OFF' ?></div>
</div>

<a href="upload.php" class="btn">Upload File</a>
<a href="logout.php" class="logout">Logout</a>
</div>

<div class="card">
<h3>Upload History</h3>
<table>
<tr>
<th>Name</th><th>ZIP Size</th><th>Date</th><th>Download</th>
</tr>
<?php foreach(array_reverse($data) as $row): ?>
<tr>
<td><?= htmlspecialchars($row['title']) ?></td>
<td><?= round($row['zip_size']/1024/1024,2) ?> MB</td>
<td><?= $row['date'] ?></td>
<td><a href="<?= $row['telegram_link'] ?>" target="_blank">Open</a></td>
</tr>
<?php endforeach; ?>
</table>
</div>

</body>
</html>