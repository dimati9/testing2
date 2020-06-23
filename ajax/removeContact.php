<?php
include_once '../common/common.php';

$result = array(
	'status' => "error",
	'message' => 'empty id',
);

if (empty($_GET['id'])) {
	echo json_encode($result);
	die();
} else {
	DB::set('DELETE FROM `contacts` WHERE `id` = ?', array($_GET['id']));

	$result = [
		'status' => 'ok',
		'message' => 'removed',
	];


}


echo json_encode($result);



