<?php
require 'config.php';
if (!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit;
}

$data = json_decode(file_get_contents(HISTORY_FILE), true);
$totalFiles = count($data);
$totalSize = array_sum(array_column($data, 'zip_size'));
?>
<!DOCTYPE html>
<html>
<head>
<title>Advanced Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
<h2>📊 Advanced Dashboard</h2>
<p>📦 Files: <?= $totalFiles ?></p>
<p>💾 Size: <?= round($totalSize / 1024 / 1024, 2) ?> MB</p>
<p>⚡ Auto ZIP: <?= AUTO_ZIP ? 'ON' : 'OFF' ?></p>
<a href="upload.php">Upload File</a> |
<a href="logout.php">Logout</a>
</div>

<div class="card">
<h3>📁 Upload History</h3>
<table>
<tr>
<th>Name</th><th>ZIP Size</th><th>Date</th><th>Download</th>
</tr>
<?php foreach ($data as $row): ?>
<tr>
<td><?= htmlspecialchars($row['name']) ?></td>
<td><?= round($row['zip_size']/1024/1024,2) ?> MB</td>
<td><?= $row['date'] ?></td>
<td><a href="<?= $row['telegram_link'] ?>">Open</a></td>
</tr>
<?php endforeach; ?>
</table>
</div>

</body>
</html>