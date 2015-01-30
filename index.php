<?php

/*
	imgcroper 0.1 alfa
*/

ini_set('display_errors', 1);
require_once $_SERVER['DOCUMENT_ROOT'].'/imgcroper/phpthumb/ThumbLib.inc.php';

$height = isset($height) ? $height : '100';
$width = isset($width) ? $width : '100';
$img = isset($img) ? $img : 'test.jpg';

if(strcmp('/', substr($img,0,1)) == 0) {
	$path_img = $_SERVER['DOCUMENT_ROOT'].$img;
} else {
	$path_img = $_SERVER['DOCUMENT_ROOT'].'/'.$img;
}

if(file_exists($path_img)) {

	$cache_img = md5($img.'x'.$width.'x'.$height);

	$path_cache = $_SERVER['DOCUMENT_ROOT'].'/imgcroper/cache/'.$cache_img.'.jpg'; 
	
	if(file_exists($path_cache)) {

	} else {

		try {
    		$thumb = PhpThumbFactory::create($path_img);
		} catch (Exception $e) {
     		// handle error here however you'd like
		} 

		$thumb->adaptiveResize($width, $height);
		$thumb->save($path_cache, 'jpg'); 
	}

	echo '/imgcroper/cache/'.$cache_img.'.jpg';	
}
