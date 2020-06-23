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
	$id = (int)$_GET['id'];
	$file = DB::getRow('SELECT * FROM `files` WHERE `id` = ?', array($id));

	if(!empty($file['name'])) {
		$result = [
			'status' => 'ok',
		];

	} else {
		$result = array(
			'status'=>"error",
			'message'=>'empty file',
		);
		echo json_encode($result);
		die();
	}

}


echo json_encode($result);




