<?php
// ===============================
// SESSION (SAFE START)
// ===============================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ===============================
// ADMIN LOGIN DETAILS
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
// GOOGLE DRIVE (Render Secret File)
// ===============================
define('GOOGLE_CREDENTIALS_PATH', '/etc/secrets/credentials.json');

// 👇 Apna Drive Folder ID yaha paste karna
define('DRIVE_FOLDER_ID', 'PASTE_YOUR_FOLDER_ID_HERE');