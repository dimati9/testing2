<?php
include_once '../common/common.php';

$result = array(
	'status'=>"error",
	'message'=>'empty id',
	'items' => [],
);

if(empty($_GET['id'])) {
	echo json_encode($result);
	die();
} else{
	if(!empty($_GET['text'])) {
		$text = '%' . softTrim($_GET['text']) . '%';
		$contacts = DB::getAll('SELECT * FROM `contacts` WHERE `userId` = ? AND (`name` LIKE ? OR `phone` LIKE ? OR `lastName` LIKE ? OR `email` LIKE ?) ',array($_GET['id'], $text,$text,$text,$text));
	} else {
		$contacts = DB::getAll('SELECT * FROM `contacts` WHERE `userId` = ?',array($_GET['id']));
	}


	if(!empty($contacts)) {
		$result = [
			'status' => 'ok',
			'items' => json_encode($contacts, JSON_UNESCAPED_UNICODE),
		];

	} else {
		$result = array(
			'status'=>"empty",
			'items' => [],
			'text' => $text,
		);
		echo json_encode($result);
		die();
	}

}


echo json_encode($result);




