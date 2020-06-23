<?php
function addError($text) {

	$fd = fopen(__DIR__."/logs/errors.log", 'a+') or die("не удалось открыть файл");
	fwrite($fd, PHP_EOL . date('d-m-y H:i') . ": " .$text);
	fclose($fd);
}


// functions
function softTrim($str) {

	$str = strip_tags($str);
	//$str = str_replace("'","`",$str);
	$str = trim($str);
	return $str;
}

function escape($str) {
	$str = htmlspecialchars($str);
	$str = str_replace("'","",$str);
	$str = str_replace('"','',$str);
	$str = str_replace('\"','',$str);
	$str = str_replace("\"","",$str);
	$str = softTrim($str);
	return $str;
}

function redirected($url) {
	echo ' <meta http-equiv="refresh" content="0;url=' . $url . '">';
}

function reArrayFiles(&$file_post) {

	$file_ary = array();
	$file_count = count($file_post['name']);
	$file_keys = array_keys($file_post);

	for ($i=0; $i<$file_count; $i++) {
		foreach ($file_keys as $key) {
			$file_ary[$i][$key] = $file_post[$key][$i];
		}
	}

	return $file_ary;
}


