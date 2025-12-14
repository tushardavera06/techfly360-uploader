<?php
require 'config.php';

if (isset($_POST['login'])) {
    if (
        $_POST['username'] === ADMIN_USERNAME &&
        $_POST['password'] === ADMIN_PASSWORD
    ) {
        $_SESSION['admin'] = true;
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
<style>
body { font-family: Arial; background:#f4f6f8; }
.box {
    width:300px; margin:120px auto; padding:20px;
    background:#fff; box-shadow:0 0 10px #ccc;
}
input, button {
    width:100%; padding:10px; margin-top:10px;
}
button {
    background:#2563eb; color:#fff; border:none;
}
</style>
</head>
<body>

<div class="box">
<h3>Admin Login</h3>

<?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>

<form method="post">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
</form>
</div>

</body>
</html>