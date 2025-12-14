<?php
// =============================
// SESSION
// =============================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// =============================
// ADMIN LOGIN
// =============================
define('ADMIN_USERNAME', 'tushar');
define('ADMIN_PASSWORD', 'Tushar@5111');

// =============================
// UPLOAD LIMIT (1GB)
// =============================
define('MAX_UPLOAD_SIZE', 1024 * 1024 * 1024);

// =============================
// GOOGLE DRIVE CONFIG
// =============================
define('GOOGLE_CREDENTIALS_PATH', '/etc/secrets/credentials.json');

// ⚠️ SAME FOLDER ID JO DRIVE URL ME HAI
define('DRIVE_FOLDER_ID', '1yhz4GsD-lnJLnCCkMhyZJnY7k9Qh6HCo');