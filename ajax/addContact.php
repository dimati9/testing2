<?php
include_once '../common/common.php';

$image = "";
$result = array(
	'status'=>"error",
	'message'=>'empty id',
);

if(!empty($_POST)) {
	$add = DB::add('INSERT INTO `contacts` SET `name` = ?, `lastName` =?, `email` = ?, `phone` = ?, `image` = ?, `userId` = ?',
		array(softTrim($_POST['name']), softTrim($_POST['lastName']), softTrim($_POST['email']), softTrim($_POST['phone']), $image, softTrim($_POST['userId'])));
	if($add) {
		if(!empty($_FILES['image']['name'])) {
			$userId = $_POST['userId'];
			$name = mt_rand(0, 10000) . $_FILES['image']['name'];
			if(!is_dir(UPLOADS_FOLDER . $userId)) {
				mkdir(UPLOADS_FOLDER . $userId, "0777", true);
			}

			copy($_FILES['image']['tmp_name'], UPLOADS_FOLDER . $userId . '/' . $name);
			$image = 'uploads/' . $userId . '/' . $name;
			DB::set('UPDATE `contacts` SET `image` = ? WHERE `id` = ?', array($image, $add));
			$result['file'] = 'ok';
		}
		$result['status'] = 'ok';
		$result['message'] = 'Пользователь успешно добавлен';
		$result['id'] = $add;


	}
}


echo json_encode($result);




