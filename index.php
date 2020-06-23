<?php

include_once './common/common.php';

$title = "Телефонная книга";

$add = '';
$page = "main.php";


if(@$_GET['page'] == 'personal') {
	$page = 'personal';
} else {
	$page = 'main';
}



$page .= ".php";
if(is_file(SITE_PATH . 'include/pages/'.$page)) {
	include_once SITE_PATH . 'include/pages/'.$page;
}

// top
if(is_file(SITE_PATH . 'templates/'.'top.php')) {
	include_once SITE_PATH . 'templates/'.'top.php';
}

if(is_file(SITE_PATH . 'templates/'.$page)) {
	include_once SITE_PATH . 'templates/'.$page;
}



init('bottom.php');
