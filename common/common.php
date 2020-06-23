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
// reCaptcha
if (! defined('SITEKEY')) {
	define('SITEKEY', '6LdUduQUAAAAANmdWnf7jNncqn7CJeGN9WfvtYsT');
}
if (! defined('SITE_PATHX')) {
	define('SITE_PATHX', dirname(dirname(__FILE__)));
}
if (! defined('TEMPLATES_FOLDER')) {
	define('TEMPLATES_FOLDER', SITE_PATH . 'templates/');
}
if (! defined('UPLOADS_FOLDER')) {
	define('UPLOADS_FOLDER', SITE_PATH . 'uploads/');
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


