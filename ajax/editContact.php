<?php
include_once '../common/common.php';

$image = "";
$result = array(
	'status'=>"error",
	'message'=>'empty id',
);

if(!empty($_POST)) {
	$contact = DB::getRow('SELECT * FROM `contacts` WHERE `id` = ?',array($_POST['contactId']));
	DB::set('UPDATE `contacts` SET `name` = ?, `lastName` =?, `email` = ?, `phone` = ? WHERE `id` = ?',
		array(softTrim($_POST['name']), softTrim($_POST['lastName']), softTrim($_POST['email']), softTrim($_POST['phone']),softTrim($_POST['contactId'])));
		if(!empty($_FILES['image']['name'])) {
			$userId = $_POST['userId'];
			$name = mt_rand(0, 10000) . $_FILES['image']['name'];
			if(!is_dir(UPLOADS_FOLDER . $userId)) {
				mkdir(UPLOADS_FOLDER . $userId, "0777", true);
			}
			unlink(SITE_PATH . $contact['image']);

			copy($_FILES['image']['tmp_name'], UPLOADS_FOLDER . $userId . '/' . $name);
			$image = 'uploads/' . $userId . '/' . $name;
			DB::set('UPDATE `contacts` SET `image` = ? WHERE `id` = ?', array($image, $_POST['contactId']));
			$result['file'] = 'ok';
		}
		$result['status'] = 'ok';
		$result['message'] = 'Пользователь успешно изменён';
		$result['id'] = $add;
}


echo json_encode($result);




