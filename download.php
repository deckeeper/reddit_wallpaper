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



// Get real path for our folder
$rootPath = realpath('images');

// Initialize archive object
$zip = new ZipArchive();
$zip->open('images.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();

?> 