<?php

if(!empty($_POST)){
	$errors = [];
	$login = softTrim($_POST['login']);
	$email = softTrim($_POST['email']);
	$password = softTrim($_POST['password']);
	$repassword = softTrim($_POST['repassword']);

	if(empty($login) || empty($email) || empty($password) || empty($repassword)) {
		$errors[] = "Ошибка, попробуйте снова";
	} else {
		if(!preg_match("/^[aA-zZ0-9\s]+$/m", $login)) {
			$errors[] = "Логин должен содержать только латинские буквы и/или цифры";
		}
		if(!preg_match("/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9]+$/m", $password)) {
			$errors[] = "Пароль должен содержать только латинские буквы и цифры";
		}
		if(!preg_match("/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/m", $email)) {
			$errors[] = "Email введён неверно";
		}
		if($password != $repassword) {
			$errors[] = "Пароли не совпадают";
		}
		$loginIsset = DB::getValue('SELECT `id` FROM `users` WHERE `login` = ?', array($login));
		$emailIsset = DB::getValue('SELECT `id` FROM `users` WHERE `email` = ?', array($email));
		if(!empty($loginIsset)) {
			$errors[] = "Такой логин уже существует";
		}
		if(!empty($emailIsset)) {
			$errors[] = "Такой email уже существует";
		}

		if(empty($errors)) {
			$id = DB::add('INSERT INTO `users` SET `login` = ?, `email` = ?, `password` = ?', array($login, $email, md5($password)));
			if(!empty($id)) {
				header('Location: '. SITE_URL . '?ok');
			}
		}
	}

} else {
	$errors[] = "Ошибка... Попробуйте позже";
}
