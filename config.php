<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* =====================
   ADMIN LOGIN
===================== */
define('ADMIN_USERNAME', 'tushar');
define('ADMIN_PASSWORD', 'Tushar@5111');

/* =====================
   UPLOAD SETTINGS
===================== */
define('MAX_UPLOAD_SIZE', 1024 * 1024 * 1024); // 1GB
define('AUTO_ZIP', true);

/* =====================
   TELEGRAM CONFIG
===================== */
define('TELEGRAM_BOT_TOKEN', getenv('TELEGRAM_BOT_TOKEN'));
define('TELEGRAM_CHAT_ID', '-1003582716458');

/* =====================
   STORAGE FILE
===================== */
define('HISTORY_FILE', __DIR__ . '/history.json');

if (!file_exists(HISTORY_FILE)) {
    file_put_contents(HISTORY_FILE, json_encode([]));
}