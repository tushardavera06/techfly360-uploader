<?php
// ===============================
// SESSION SETTINGS (SAFE)
// ===============================
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.gc_maxlifetime', 300);
    ini_set('session.cookie_lifetime', 300);
    session_start();
}

// ===============================
// ADMIN LOGIN CONFIG
// ===============================
define('ADMIN_USERNAME', 'tushar');

// Password: Tushar@5111
define(
    'ADMIN_PASSWORD_HASH',
    '$2y$10$KQ3t4eZ2K6qf6mX8j8lYw.6gqYJc2QqZrGzYcJ7dR7ZxV9p8GZb4G'
);

// ===============================
// UPLOAD LIMIT (1GB)
// ===============================
define('MAX_UPLOAD_SIZE', 1024 * 1024 * 1024);

// ===============================
// GOOGLE DRIVE CONFIG
// ===============================
define('GOOGLE_CREDENTIALS_PATH', '/etc/secrets/credentials.json');

// ⚠️ Yaha apna Drive Folder ID paste karna
define('DRIVE_FOLDER_ID', 'PASTE_YOUR_FOLDER_ID_HERE');