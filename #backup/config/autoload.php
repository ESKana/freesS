<?php /* AUTOLOAD.PHP */

session_start();

require('config.php');
require('functions/database.fn.php');
require('functions/tweet.fn.php');
require('functions/user.fn.php');

$database = array(
	'host'		=>	'localhost',
	'port'		=>	8012,//3306, // 8889 pour Mac avec MAMP et 3306 pour Windows
	'username'	=>	'root', // Généralement "root"
	'password'	=>	'', // Généralement "root" sur Mac et "" (vide) sur Windows 
	'database'	=>	'webdesign_twitter'
);

// Connexion à la base de données
$db = getPDO($database);