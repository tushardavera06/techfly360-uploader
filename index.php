<?php
require 'config.php';

if (!isset($_SESSION['login'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (
            $_POST['username'] === ADMIN_USERNAME &&
            $_POST['password'] === ADMIN_PASSWORD
        ) {
            $_SESSION['login'] = true;
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid username or password";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="box">
<h2>Admin Login</h2>

<?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

<form method="post">
<input name="username" placeholder="Username" required>
<input name="password" type="password" placeholder="Password" required>
<button>Login</button>
</form>
</div>

</body>
</html>
<?php exit; } ?>

<!DOCTYPE html>
<html>
<head>
<title>Telegram Hybrid Storage</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="box">
<h2>Upload File (Auto ZIP)</h2>

<form id="uploadForm" enctype="multipart/form-data">
<input type="text" name="zip_name" placeholder="ZIP name (optional)">
<input type="file" name="file" required>
<button type="submit">Upload</button>
</form>

<div class="progress">
<div id="bar"></div>
</div>
<p id="percent">0%</p>

<p id="result"></p>

<a href="logout.php">Logout</a>
</div>

<script>
document.getElementById('uploadForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    let xhr = new XMLHttpRequest();

    xhr.open('POST', 'upload.php', true);

    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            let p = Math.round((e.loaded / e.total) * 100);
            document.getElementById('bar').style.width = p + '%';
            document.getElementById('percent').innerText = p + '%';
        }
    };

    xhr.onload = function() {
        document.getElementById('result').innerHTML = xhr.responseText;
    };

    xhr.send(formData);
});
</script>

</body>
</html>