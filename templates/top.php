<!doctype html>
<html lang="ru">
<head>

	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">


	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
		  integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="<?=SITE_URL?>styles/bootstrap.min.css">
	<link rel="stylesheet" href="<?=SITE_URL?>styles/style.css">



	<!--  fancybox  -->
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<!--  fancybox -->

	<script src="/scripts/jquery.maskedinput.min.js?<?=filemtime($_SERVER['DOCUMENT_ROOT'] . '/scripts/jquery.maskedinput.min.js')?>"></script>
	<script src="<?= SITE_URL ?>/scripts/jquery.cookie.js?"></script>
	<script src="<?= SITE_URL ?>/scripts/script.js?<?=filemtime($_SERVER['DOCUMENT_ROOT'] . '/script.js')?>">"></script>




	<!-- metrica	-->

	<div class="metrica">
		<?= include_once 'metrica.php'; ?>
	</div>

</head>
<body>
<?php init('header.php') ?>
