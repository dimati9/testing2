<?php

$auth = 0;

if(isset($_GET['out'])) {
	$_SESSION['auth'] = "";
	header('Location: '. SITE_URL);
}

if(empty($_SESSION['auth'])) {
	include_once 'forms/add.php';
} else {
	header('Location: '. SITE_URL . 'personal');
}

if(isset($_GET['ok'])) {
	$messages[] = "Вы успешно зарегистриовались";
	$messages[] = "Авторизуйтесь";
}
