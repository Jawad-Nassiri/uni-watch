<?php





$sessionLifetime = 31536000;


session_set_cookie_params($sessionLifetime);


ini_set('session.gc_maxlifetime', $sessionLifetime);

require "autoload.php";
session_start();
include "functions.inc.php";
define("ROOT", "/uni-watch/");
define("IMG_ROOT", "/uni-watch/public/assets/images/");