<?php
require "config.php";

if (!isset($_SESSION['login'])):
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body class="login-body">
<form method="POST" class="login-box">
<h2>Techfly360 Login</h2>
<input name="username" placeholder="Username" required>
<input name="password" type="password" placeholder="Password" required>
<button>Login</button>
<?php if(isset($error)) echo "<p class='err'>$error</p>"; ?>
</form>
</body>
</html>
<?php exit; endif; ?>

<?php
$history = file_exists("history.json")
    ? json_decode(file_get_contents("history.json"), true)
    : [];
?>

<!DOCTYPE html>
<html>
<head>
<title>Techfly360 Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
<h2>🚀 Techfly360</h2>
<a>Dashboard</a>
<a>Upload</a>
<a>History</a>
<a href="logout.php">Logout</a>
</div>

<div class="main">

<div class="cards">
<div class="card blue">📁 Files<br><?= count($history) ?></div>
<div class="card purple">💾 Storage<br>
<?php
$size = array_sum(array_column($history, 'bytes'));
echo round($size/1024/1024,2)." MB";
?>
</div>
<div class="card green">⚡ Auto ZIP<br>ON</div>
</div>

<h3>Upload File (Auto ZIP)</h3>

<form id="uploadForm">
<input name="filename" placeholder="Enter file name" required>
<input type="file" name="file" required>
<button>Upload</button>

<div class="progress">
<div id="bar"></div>
</div>
<span id="percent">0%</span>
</form>

<h3>Upload History</h3>
<table>
<tr><th>Name</th><th>ZIP Size</th><th>Date</th><th>Download</th></tr>

<?php if(empty($history)): ?>
<tr><td colspan="4">No uploads yet</td></tr>
<?php else: foreach(array_reverse($history) as $h): ?>
<tr>
<td><?=htmlspecialchars($h['name'])?></td>
<td><?=round($h['bytes']/1024/1024,2)?> MB</td>
<td><?=$h['date']?></td>
<td><a href="<?=$h['link']?>">Download</a></td>
</tr>
<?php endforeach; endif; ?>

</table>
</div>

<script src="app.js"></script>
</body>
</html>