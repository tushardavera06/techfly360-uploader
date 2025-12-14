<?php
// ===============================
// SESSION
// ===============================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ===============================
// ADMIN LOGIN (DIRECT)
// ===============================
define('ADMIN_USERNAME', 'tushar');
define('ADMIN_PASSWORD', 'Tushar@5111');

// ===============================
// UPLOAD LIMIT (1GB)
// ===============================
define('MAX_UPLOAD_SIZE', 1024 * 1024 * 1024);

// ===============================
// GOOGLE DRIVE
// ===============================
define('GOOGLE_CREDENTIALS_PATH', '/etc/secrets/credentials.json');
define('DRIVE_FOLDER_ID', 'PASTE_YOUR_FOLDER_ID_HERE');