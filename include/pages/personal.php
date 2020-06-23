<?php

$auth = 0;

if(empty($_SESSION['auth'])) {
	header('Location: ' . SITE_URL);
} else {

	$users = DB::getAll('SELECT * FROM `users`');
	$userData = [];
	foreach ($users as $user) {
		if(md5($user['email']) == $_SESSION['auth']) {
			$auth = 1;
			$userData = $user;
			break;
		}
	}
	if(!$auth) {
		header('Location: ' . SITE_URL);
	}
}


debugShow($_POST);
debugShow($_GET);
debugShow($_SESSION);
debugShow($userData);
