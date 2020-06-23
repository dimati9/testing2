<?php
ini_set('display_errors','E_ERROR');
session_start();
require 'pdo.php';
require 'functions.php';

define("SITE_URLX", "test.test");
define("SITE_URL", "http://test.test/");
if (! defined('SITE_PATH')) {
	define('SITE_PATH', dirname(dirname(__FILE__)) . '/');
}
if (! defined('SITE_PATHX')) {
	define('SITE_PATHX', dirname(dirname(__FILE__)));
}
if (! defined('TEMPLATES_FOLDER')) {
	define('TEMPLATES_FOLDER', SITE_PATH . 'templates/');
}
if (! defined('UPLOADS_FOLDER')) {
	define('UPLOADS_FOLDER', SITE_PATH . 'upload/');
}
$deleteChars = ['"', ".", "'", "!"];

function debugShow($msg) {
    echo '<pre>';
    print_r($msg);
    echo '</pre>';
}

if(isset($_POST['action'])) {
	if(is_file(SITE_PATH . 'include/actions/'.$_POST['action'].'.php')) {
		include_once SITE_PATH . 'include/actions/'.$_POST['action'].'.php';
	}
}


function init($page) {
	if(is_file(SITE_PATH . 'include/pages/'.$page)) {
		include_once SITE_PATH . 'include/pages/'.$page;
	}
	if(is_file(SITE_PATH . 'templates/'.$page)) {
		include_once SITE_PATH . 'templates/'.$page;
	}
}

$USERID = [];
$auth = 0;
if(!empty($_SESSION['auth'])) {
	$users = DB::getAll('SELECT * FROM `users` ');

	$user = "";
	foreach ($users as $thisUser) {
		if(md5($thisUser['email']) == $_SESSION['auth']) {
			$USERID = $thisUser;
			$auth = 1;
		}
	}

	if(empty($USERID)) {
		unset($_SESSION['auth']);
	}
}
