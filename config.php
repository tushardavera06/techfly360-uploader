<?php
// Session settings FIRST
ini_set('session.gc_maxlifetime', 300);
ini_set('session.cookie_lifetime', 300);

// Now start session
session_start();

define('ADMIN_USER', 'admin');
define('ADMIN_PASS_HASH', password_hash('STRONG_PASSWORD', PASSWORD_BCRYPT));

define('MAX_SIZE', 1024 * 1024 * 1024); // 1GB
define('DRIVE_FOLDER_ID', 'YOUR_FOLDER_ID');