<?php
session_start();

/* BASIC AUTH (single user) */
$USERNAME = "tushar";
$PASSWORD = "Tushar@5111";

/* Telegram */
define("BOT_TOKEN", getenv("BOT_TOKEN"));   // Render ENV
define("CHAT_ID", "-1003582716458");         // Tumhara channel ID

/* Login check */
if (!isset($_SESSION['login'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['username'] === $USERNAME && $_POST['password'] === $PASSWORD) {
            $_SESSION['login'] = true;
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid login";
        }
    }
}