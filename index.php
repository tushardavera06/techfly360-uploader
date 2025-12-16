<?php
require 'config.php';

if (isset($_SESSION['login'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        $_POST['username'] === ADMIN_USERNAME &&
        $_POST['password'] === ADMIN_PASSWORD
    ) {
        $_SESSION['login'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Login</title>
</head>
<body>
<div class="card">
<h2>Admin Login</h2>
<?php if($error): ?><p class="error"><?= $error ?></p><?php endif; ?>
<form method="post">
<input name="username" placeholder="Username" required>
<input name="password" type="password" placeholder="Password" required>
<button>Login</button>
</form>
</div>
</body>
</html>