<?php

if(!$auth) {
	include_once 'forms/add.php';
} else {
	header('Location:' . SITE_URL . 'personal');
}


