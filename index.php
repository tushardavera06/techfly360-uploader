<?php
require 'config.php';

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: upload.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        $_POST['username'] === ADMIN_USERNAME &&
        $_POST['password'] === ADMIN_PASSWORD
    ) {
        $_SESSION['login'] = true;
        header("Location: upload.php");
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
<div class="login-box">
    <h2>Admin Login</h2>
    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>