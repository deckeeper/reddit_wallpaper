<?php

 
include_once 'php_html_dom/simple_html_dom.php';
$html = file_get_html('https://www.reddit.com/r/wallpapers/top/');
$files = array();

foreach($html->find('img') as $element){
	$links = $element->src;
	$desired_link = substr($links, 0, 15);
	if ($desired_link=='https://preview') {
		$final_link = str_replace("https://preview","https://i",$links);
		$final_link_cropped = explode('?', $final_link)[0];
		//$final_link_cropped = explode('i.redd.it/', $final_link_cropped[0]);
		array_push($files,$final_link_cropped);
		//file_put_contents('images/'.$final_link_cropped[1], file_get_contents($final_link));
	}
} 

foreach($html->find('a') as $element){
	$links = $element->href;
	$desired_link = substr($links, 0, 15);
	if ($desired_link=='https://i.imgur') {
		$final_link = explode("/", $links)[3];
		array_push($files,$links);
		//file_put_contents('images/'.$final_link, file_get_contents($links));
}
}     


$html = file_get_html('https://www.reddit.com/r/wallpaper/top/');


foreach($html->find('img') as $element){
	$links = $element->src;
	$desired_link = substr($links, 0, 15);
	if ($desired_link=='https://preview') {
		$final_link = str_replace("https://preview","https://i",$links);
		$final_link_cropped = explode('?', $final_link)[0];
		//$final_link_cropped = explode('i.redd.it/', $final_link_cropped[0]);
		array_push($files,$final_link_cropped);
		//file_put_contents('images/'.$final_link_cropped[1], file_get_contents($final_link));
	}
} 

foreach($html->find('a') as $element){
	$links = $element->href;
	$desired_link = substr($links, 0, 15);
	if ($desired_link=='https://i.imgur') {
		$final_link = explode("/", $links)[3];
		array_push($files,$links);
		//file_put_contents('images/'.$final_link, file_get_contents($links));
}
} 

# create new zip object
$zip = new ZipArchive();

# create a temp file & open it
$tmp_file = tempnam('.', '');
$zip->open($tmp_file, ZipArchive::CREATE);

# loop through each file
foreach ($files as $file) {
    # download file
    $download_file = file_get_contents($file);

    #add it to the zip
    $zip->addFromString(basename($file), $download_file);
}

# close zip
$zip->close();

# send the file to the browser as a download
header('Content-disposition: attachment; filename="reddit_images.zip"');
header('Content-type: application/zip');
readfile($tmp_file);
unlink($tmp_file);

?> 