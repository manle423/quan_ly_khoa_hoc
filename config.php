<?php
// Thông số của CSDL    
// Người viết: Nhóm 5 Anh em siêu nhân
// Ngày: 18/01/2024
define('DB_HOST', 'localhost');
define('DB_NAME', 'lms');
// Default user root
define('DB_USER', 'ct06');
// Default password 'mysql' 
define('DB_PASS', '123456');
// define('DEBUG', true);

define('WEB_HOST', 'http://' . $_SERVER['HTTP_HOST']);
define('WEB_PATH', __DIR__);

define('FILE_MAX_SIZE', 2 * 1024 * 1024);
define('FILE_TYPE', ['image/gif', 'image/png', 'image/jpeg', 'image/jpg']);