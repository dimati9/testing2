<?php
include_once '../common/common.php';

$result = array(
	'status'=>"error",
	'message'=>'empty id',
);

if(empty($_GET['id'])) {
	echo json_encode($result);
	die();
} else{
	$contact = DB::getRow('SELECT * FROM `contacts` WHERE `id` = ?',array($_GET['id']));

	if(!empty($contact)) {
		$contact['phoneText'] = numberToText($contact['phone']);
		$result = [
			'status' => 'ok',
			'item' => json_encode($contact, JSON_UNESCAPED_UNICODE),
		];

	} else {
		$result = array(
			'status'=>"empty",
		);
		echo json_encode($result);
		die();
	}

}


echo json_encode($result);




