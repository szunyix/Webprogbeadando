<?php 
define('BASE_DIR', './'); #alapmappa
define('PUBLIC_DIR', BASE_DIR.'poblic/');
define('PROTECTED_DIR', BASE_DIR.'protected/');

define('DATABASE_CONTROLLER', PROTECTED_DIR.'database.php'); #elérhetőség megnevezés # fügvények elérhetősége                            
define('USER_MENAGER', PROTECTED_DIR.'userManeger.php');

define('DB_TYPE', 'mysql'); # connection adatbázishoz
define('DB_HOST', 'localhost');
define('DB_NAME', 'cd36qy');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');
?>