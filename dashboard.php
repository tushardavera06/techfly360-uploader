<?php
require 'config.php';
if (empty($_SESSION['auth'])) { header('Location:index.php'); exit; }
?>
<!doctype html>
<html>
<head>
<title>Upload</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
  <h1>Upload File</h1>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <label>Select file</label>
    <input type="file" name="file" required>
    <button>Upload to Drive</button>
  </form>
  <div class="small"><a href="logout.php">Logout</a></div>
</div>
</body>
</html>