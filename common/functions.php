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

function numberToText ($sourceNumber){
	if($sourceNumber < 0) {
		return false;
	}

	$smallNumbers=array(
		array('ноль'),
		array('','один','два','три','четыре','пять','шесть','семь','восемь','девять'),
		array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать',
			'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать'),
		array('','','двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят','восемьдесят','девяносто'),
		array('','сто','двести','триста','четыреста','пятьсот','шестьсот','семьсот','восемьсот','девятьсот'),
		array('','одна','две')
	);
	$degrees=array(
		array('тысяч','а','и',''), //10^3
		array('миллион','','а','ов'), //10^6
		array('миллиард','','а','ов'), //10^9
		array('триллион','','а','ов'), //10^12
		array('квадриллион','','а','ов'), //10^15
		array('квинтиллион','','а','ов'), //10^18
		array('секстиллион','','а','ов'), //10^21
		array('септиллион','','а','ов'), //10^24
		array('октиллион','','а','ов'), //10^27
		array('нониллион','','а','ов'), //10^30
		array('дециллион','','а','ов') //10^33

	);

	if ($sourceNumber==0) return $smallNumbers[0][0];
	$sign = '';
	if ($sourceNumber<0) {
		$sign = 'минус ';
		$sourceNumber = substr ($sourceNumber,1);
	}
	$result=array();

	$digitGroups = array_reverse(str_split(str_pad($sourceNumber,ceil(strlen($sourceNumber)/3)*3,'0',STR_PAD_LEFT),3));
	foreach($digitGroups as $key=>$value){
		$result[$key]=array();
		//Преобразование трёхзначного числа прописью по-русски
		foreach ($digit=str_split($value) as $key3=>$value3) {
			if (!$value3) continue;
			else {
				switch ($key3) {
					case 0:
						$result[$key][] = $smallNumbers[4][$value3];
						break;
					case 1:
						if ($value3==1) {
							$result[$key][]=$smallNumbers[2][$digit[2]];
							break 2;
						}
						else $result[$key][]=$smallNumbers[3][$value3];
						break;
					case 2:
						if (($key==1)&&($value3<=2)) $result[$key][]=$smallNumbers[5][$value3];
						else $result[$key][]=$smallNumbers[1][$value3];
						break;
				}
			}
		}
		$value*=1;
		if (!$degrees[$key]) $degrees[$key]=reset($degrees);


		if ($value && $key) {
			$index = 3;
			if (preg_match("/^[1]$|^\\d*[0,2-9][1]$/",$value)) $index = 1; //*1, но не *11
			else if (preg_match("/^[2-4]$|\\d*[0,2-9][2-4]$/",$value)) $index = 2; //*2-*4, но не *12-*14
			$result[$key][]=$degrees[$key][0].$degrees[$key][$index];
		}
		$result[$key]=implode(' ',$result[$key]);
	}

	return $sign.implode(' ',array_reverse($result));
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


