<?php

 
include_once 'php_html_dom/simple_html_dom.php';

$html = file_get_html('https://www.reddit.com/r/wallpapers/top/');

foreach($html->find('img') as $element){
	$links = $element->src;
	$desired_link = substr($links, 0, 15);
	if ($desired_link=='https://preview') {
		$final_link = str_replace("https://preview","https://i",$links);
		$final_link_cropped = explode('?', $final_link);
		$final_link_cropped = explode('i.redd.it/', $final_link_cropped[0]);
		file_put_contents('images/'.$final_link_cropped[1], file_get_contents($final_link));
	}
} 

foreach($html->find('a') as $element){
	$links = $element->href;
	$desired_link = substr($links, 0, 15);
	if ($desired_link=='https://i.imgur') {
		$final_link = explode("/", $links)[3];
		file_put_contents('images/'.$final_link, file_get_contents($links));
}
}     


$html = file_get_html('https://www.reddit.com/r/wallpaper/top/');


foreach($html->find('img') as $element){
	$links = $element->src;
	$desired_link = substr($links, 0, 15);
	if ($desired_link=='https://preview') {
		$final_link = str_replace("https://preview","https://i",$links);
		$final_link_cropped = explode('?', $final_link);
		$final_link_cropped = explode('i.redd.it/', $final_link_cropped[0]);
		file_put_contents('images/'.$final_link_cropped[1], file_get_contents($final_link));
	}
} 

foreach($html->find('a') as $element){
	$links = $element->href;
	$desired_link = substr($links, 0, 15);
	if ($desired_link=='https://i.imgur') {
		$final_link = explode("/", $links)[3];
		file_put_contents('images/'.$final_link, file_get_contents($links));
}
} 

?> 