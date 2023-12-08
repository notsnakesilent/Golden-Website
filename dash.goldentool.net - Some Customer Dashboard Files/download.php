<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php

if (isset($_GET['pin'])) {
	
	$PIN = $_GET['pin'];

   	$context = stream_context_create([
		'http' => ['ignore_errors' => true],
	]);
	
	$content = file_get_contents("your api");
	
	if (strpos($http_response_header[0], '404') !== false) {
$redirectUrl = "https://dl.goldentool.net/invalid.html";
header("Location: " . $redirectUrl);
    exit();
	}
	
	$DATA = json_decode($content);
   
  
   
    if (strpos($DATA->response, "unused") !== false) {
    {
        $partes = explode("-", $DATA->response);

         header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=Golden-'.$PIN.'.exe');
        ob_clean();
		flush();
        readfile('chinchenhanchin.exe');
		

		
        $respJson = file_get_contents("your api");
        

     
        exit();
	} 
	else 

	{
		
$redirectUrl = "https://dl.goldentool.net/invalid.html";
header("Location: " . $redirectUrl);
exit;
	}
	
   
} else {
  	
$redirectUrl = "https://dl.goldentool.net/invalid.html";
header("Location: " . $redirectUrl);
    exit();
}

?>
