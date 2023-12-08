<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php

if (isset($_GET['pin'])) {
	
	$PIN = $_GET['pin'];
    $skey = "ada2d32e4f897f601270976c24b13b1f";

   	$context = stream_context_create([
		'http' => ['ignore_errors' => true],
	]);
	
	$content = file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $skey."&type=getvar&user=PinManager&var=".$PIN, false, $context);
	
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
		

		
        $respJson = file_get_contents("https://keyauth.win/api/seller/?sellerkey=" . $skey . "&type=setvar&user=PinManager&var=" . $PIN."&data=downloaded-".$partes[0]);
        

        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $webhookUrl = 'https://discord.com/api/webhooks/1149043744553840760/1bWazfawtrOReiOATqcyto0_2pFyAIiW8mxw39MrgLf_GYQQ0pSV2369l_nqiyvOdzO4';
        $data = array(
            "content" => null,
            "embeds" => array(
                array(
                    "title" => "New Download",
                    "color" => null,
                    "fields" => array(
                        array(
                            "name" => "PIN Used",
                            "value" => $PIN
                        ),
                        array(
                            "name" => "IP Address",
                            "value" => $ipAddress
                        ),
                        array(
                            "name" => "Web Agent",
                            "value" => $userAgent
                        )
                    )
                )
            ),
            "attachments" => array()
        );

        	
$contenido = file_get_contents('stats.txt');

// Divide la cadena en partes por espacios en blanco
$partes = explode("\n", $contenido);
file_put_contents("stats.txt", "");




foreach ($partes as $parte) {

   	 $etiquetaNumero = explode("-", $parte);

        $etiqueta = $etiquetaNumero[0];
        $numero = intval($etiquetaNumero[1]);

		if ($etiqueta == "Downloads") {
			$archivoStream = fopen("stats.txt", "a");

			if ($archivoStream) {
				fwrite($archivoStream, $etiqueta."-".strval($numero + 1)."\n");
				fclose($archivoStream);
			}
		}
		
		if ($etiqueta == "Scans") {
			$archivoStream = fopen("stats.txt", "a");

if ($archivoStream) {
    fwrite($archivoStream, $etiqueta."-".strval($numero)."\n");  
    fclose($archivoStream);
}

		}
		
		if ($etiqueta == "Pins Generated") {
			$archivoStream = fopen("stats.txt", "a");

			if ($archivoStream) {
				fwrite($archivoStream, $etiqueta."-".strval($numero)."\n");  
				fclose($archivoStream);
			}
			
		}
    
}



        $jsonPayload = json_encode($data);
        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            
        }
        curl_close($ch);
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
