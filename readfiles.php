<?php
$path =  $_GET['path'];
if($path){
	$files 		= array();
	$thumbsF 	= array();
	$imgDir 	= $path;
	$thumbDir 	= $imgDir.'/thumbs';

	if($imgDir && $thumbDir){
		//check if folder name it's correct
		if(is_dir($imgDir) && is_dir($thumbDir)){
			//start opening the dirs
			$dir = opendir($path);
			$thumbs = opendir($thumbDir);
			//read the big images folder
			while($file = readdir($dir)) {
				if($file == '.' || $file == '..') {
					continue;
				}
				$files[] = $file;
			}

			//read the thumbs folders
			while($thumb = readdir($thumbs)) {
				if($thumb == '.' || $thumb == '..') {
					continue;
				}
				//add _thumb for thumbs for displaying porpuse
				$thumbsF[] = 'thumb_'.$thumb;
				
			}

			//return both arrays into one array
			$returnFiles = array_merge($files, $thumbsF);
			$encodeJsonRes = $returnFiles;
		}else{
			$encodeJsonRes = 'Sorry but the folder name are not correct or missing!';
		}
		header('Content-type: application/json');
		//send json response to js with the proper result
		echo json_encode($encodeJsonRes);
	}
}
?>