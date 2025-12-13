<?php
session_start();

/* ===== ADMIN LOGIN ===== */
define('ADMIN_USER', 'admin');
define('ADMIN_PASS_HASH', password_hash('STRONG_PASSWORD_HERE', PASSWORD_BCRYPT));

/* ===== UPLOAD RULES ===== */
define('MAX_SIZE', 1024 * 1024 * 1024); // 1GB
define('DRIVE_FOLDER_ID', 'YOUR_DRIVE_FOLDER_ID');

/* ===== SECURITY ===== */
ini_set('session.gc_maxlifetime', 300); // 5 min