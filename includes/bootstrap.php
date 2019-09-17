<?php 
define('APP_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);

require_once APP_PATH . 'config.php';
require_once APP_PATH . 'classes/Database.php';
require_once APP_PATH . 'classes/User.php';
require_once APP_PATH . 'classes/Gallery.php';
require_once APP_PATH . 'classes/Recipe_post.php';
require_once APP_PATH . 'classes/Rating.php';
require_once APP_PATH . 'classes/Favorite.php';
require_once APP_PATH . 'includes/functions.php';


// We are changing the by default session to new one
$session_name = get_config('session', 'name');
session_name($session_name);
session_start();
