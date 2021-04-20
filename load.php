<?php
define('ABSPATH', __DIR__);
define('ADMIN_PATH', ABSPATH . '/admin');
define('ADMIN_SCRIPT_PATH', ADMIN_PATH . '/scripts');

session_start();

// db config
require_once ABSPATH.'/config/database.php';


//admin shit
require_once ADMIN_SCRIPT_PATH.'/functions.php';
require_once ADMIN_SCRIPT_PATH.'/blog.php';
require_once ADMIN_SCRIPT_PATH.'/resources.php';
require_once ADMIN_SCRIPT_PATH.'/login.php';
require_once ADMIN_SCRIPT_PATH.'/read.php';
require_once ADMIN_SCRIPT_PATH.'/user.php';



require_once ADMIN_SCRIPT_PATH.'/mail.php';