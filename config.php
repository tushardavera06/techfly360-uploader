<?php
// ================= SESSION =================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ================= LOGIN =================
define('ADMIN_USERNAME', 'tushar');
define('ADMIN_PASSWORD', 'Tushar@5111');

// ================= TELEGRAM =================
define('BOT_TOKEN', 'PASTE_YOUR_BOT_TOKEN');
define('CHANNEL_ID', '-1003582716458');

// ================= UPLOAD =================
define('MAX_UPLOAD_SIZE', 1024 * 1024 * 1024); // 1GB
define('AUTO_ZIP', true);

// ================= STORAGE =================
define('DATA_FILE', __DIR__ . '/history.json');
define('TEMP_DIR', __DIR__ . '/tmp');

if (!file_exists(TEMP_DIR)) {
    mkdir(TEMP_DIR, 0777, true);
}