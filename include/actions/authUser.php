<?php

if(!empty($_POST)){
	$email = softTrim($_POST['email']);
	$password = softTrim($_POST['password']);
	$user = DB::getValue('SELECT `id` FROM `users` WHERE `email` = ? AND `password` = ?', array($email, md5($password)));
	if(!empty($user)) {
		$_SESSION['auth'] = md5($email);
		header('Location: ' . SITE_URL . 'personal');
	} else {
		$errors[] = "Неверный логин или пароль";
	}
}
