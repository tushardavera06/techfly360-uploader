<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD']==='POST') {
  if ($_POST['user']===ADMIN_USERNAME &&
      password_verify($_POST['pass'], ADMIN_PASSWORD_HASH)) {
    $_SESSION['auth']=true;
    header('Location: dashboard.php'); exit;
  }
}
?>
<!doctype html>
<html>
<head>
<title>Admin Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
  <h1>Admin Login</h1>
  <form method="post">
    <label>Username</label>
    <input name="user" required>
    <label>Password</label>
    <input type="password" name="pass" required>
    <button>Login</button>
  </form>
</div>
</body>
</html>