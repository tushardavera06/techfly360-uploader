<?php
// ===============================
// SESSION
// ===============================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ===============================
// ADMIN LOGIN
// ===============================
define('ADMIN_USERNAME', 'tushar');
define('ADMIN_PASSWORD', 'Tushar@5111');

// ===============================
// TELEGRAM CONFIG
// ===============================
define('BOT_TOKEN', '8370542639:AAFL9iIVbvxPMcqc29Zlg0wQtA3pME4PiQI');
define('CHANNEL_ID', '-1003582716458');

// ===============================
// UPLOAD LIMIT (2GB)
// ===============================
define('MAX_UPLOAD_SIZE', 2 * 1024 * 1024 * 1024);