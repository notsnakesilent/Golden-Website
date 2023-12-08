
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Effective and accurate screenshare solutions">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="./img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Golden - Dashboard</title>

	<link href="./app.css" rel="stylesheet">
	<link href="./style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
	<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

	<script>
	 window.addEventListener('load', () => {
    const loadingScreen = document.getElementById('loading-screen');
  //  loadingScreen.style.display = 'none';

    const content = document.getElementById('content');
    content.style.display = 'block';
});
	</script>
</head>

<body>


	
<?php
include './credentials.php';
require './keyauth.php';

function errorHandler($errno, $errstr, $errfile, $errline) {
		echo "<meta http-equiv='Refresh' Content='2; url=501.html'>";
    exit();
}

//set_error_handler('errorHandler');


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['un'])) {
    header("Location: ./index.php");
    exit();
}


if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ./index.php");
    exit();
}

$key = "frambuesaslol123";

function decryptAES($encryptedData, $key) {
    $cipher = "aes-128-ecb";
    $options = OPENSSL_RAW_DATA;
    $decryptedData = openssl_decrypt(hex2bin($encryptedData), $cipher, $key, $options);
    return $decryptedData;
}	

function encryptAES($data, $key) {
    $cipher = "aes-128-ecb";
    $options = OPENSSL_RAW_DATA;
    $encryptedData = openssl_encrypt($data, $cipher, $key, $options);
    return bin2hex($encryptedData); 
}


$KeyAuthApp = new KeyAuth\api($name, $ownerid);

$url = "https://keyauth.win/api/seller/?sellerkey={$sellerkey}&type=getsettings";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($curl);
$json = json_decode($resp);

if (!$json->success) {
    die("Error: {$json->message}");
}

$download = $json->download;
$webdownload = $json->webdownload;
$appcooldown = $json->cooldown;


function findSubscription($name, $list)
{
    for ($i = 0; $i < count($list); $i++) {
        if ($list[$i]->subscription == $name) {
            return true;
        }
    }
    return false;
}

$username = $_SESSION["user_data"]["username"];

$respJson = file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=userdata&user=" . $username );
$DATA = json_decode($respJson);



if (isset($_POST['addEmail'])) {
	$email = $_POST["addEmail"];

	$respJson = file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=fetchalluservars");
	$data = json_decode($respJson);

	foreach ($data->vars as $var) {
		if (isset($var->data) && strpos($var->data, $email) !== false) {
			$lolFound = true;
			break;  // Puedes detener el bucle si ya has encontrado "lol" en alguna variable
		}
	}

	if ($lolFound) {
		echo 'alreadyExists';
		exit;
	}
	


	$respJson = file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=setvar&user=" . $username ."&var=email&data=". $email);
	$respJson = file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=setvar&user=" . $username ."&var=verified&data=false");

	$ip = $_SERVER['REMOTE_ADDR'];
														$api_url = "http://ipinfo.io/$ip/json";
$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($ch);
curl_close($ch);

// Decodifica la respuesta JSON
$data = json_decode($json, true);

// Verifica si la consulta fue exitosa y muestra el país
if ($data && isset($data['country'])) {
    $country = $data['country'];
}
	$to= $email;
	$subject ="Email verification";
	$message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><link href="chrome-extension://cmeakgjggjdlcpncigglobpjbkabhmjl/css/flag-icon.css" rel="stylesheet" type="text/css"><link href="chrome-extension://cmeakgjggjdlcpncigglobpjbkabhmjl/css/fonts/roboto.css" rel="stylesheet" type="text/css"><link href="chrome-extension://cmeakgjggjdlcpncigglobpjbkabhmjl/css/fonts/manrope.css" rel="stylesheet" type="text/css"><link href="chrome-extension://cmeakgjggjdlcpncigglobpjbkabhmjl/js/jquery/pagination.css" rel="stylesheet" type="text/css">
	
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="format-detection" content="date=no">
		<meta name="format-detection" content="address=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="x-apple-disable-message-reformatting">
		<title>Golden - Email Verify</title>
	
		<style type="text/css" media="screen">
			@font-face {
				font-family: "Motiva Sans";
				font-style: normal;
				font-weight: 300;
				src: local("Motiva Sans"), url("https://store.cloudflare.steamstatic.com/public/shared/fonts/email/MotivaSans-Light.woff") format("woff");
			}
	
			@font-face {
				font-family: "Motiva Sans";
				font-style: normal;
				font-weight: normal;
				src: local("Motiva Sans"), url("https://store.cloudflare.steamstatic.com//public/shared/fonts/email/MotivaSans-Regular.woff") format("woff");
			}
	
			@font-face {
				font-family: "Motiva Sans";
				font-style: normal;
				font-weight: bold;
				src: local("Motiva Sans"), url("https://store.cloudflare.steamstatic.com//public/shared/fonts/email/MotivaSans-Bold.woff") format("woff");
			}
	
			[style*="Motiva Sans"] {
				font-family: "Motiva Sans", Arial, sans-serif !important;
			}
		</style>
	
	
		<style type="text/css" media="screen">
			body { padding:0 !important; margin:0 auto !important; display:block !important; min-width:100% !important; width:100% !important; background:#ffffff; -webkit-text-size-adjust:none }
			a { color:#7abefa; text-decoration:underline }
			body a { color:#ffffff; text-decoration:underline }
			img { margin: 0 !important; -ms-interpolation-mode: bicubic;}
	
		   
				table { mso-table-lspace:0pt; mso-table-rspace:0pt; }
				img, a img{ border:0; outline:none; text-decoration:none; }
				#outlook a { padding:0; }
				.ReadMsgBody { width:100%; }
				.ExternalClass { width:100%; }
				div,p,a,li,td,blockquote { mso-line-height-rule:exactly; }
				a[href^=tel],a[href^=sms] { color:inherit; text-decoration:none; }
				.ExternalClass, .ExternalClass p, .ExternalClass td, .ExternalClass div, .ExternalClass span, .ExternalClass font { line-height:100%; }
		 
	
			a[x-apple-data-detectors] { color: inherit !important; text-decoration: inherit !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; }
	
			.btn-18 a { display: block; padding: 13px 35px; text-decoration: none; }
	
			.l-white a { color: #ffffff; }
			.l-black a { color: #000001; }
			.l-grey1 a { color: #dbdee2; }
			.l-grey2 a { color: #a1a2a4; }
			.l-grey3 a { color: #dadcdd; }
			.l-grey4 a { color: #f1f1f1; }
			.l-grey5 a { color: #dddedf; }
			.l-grey6 a { color: #bfbfbf; }
			.l-grey7 a { color: #dcdddd; }
			.l-grey8 a { color: #8e96a4; }
			.l-green a { color: #a4d007; }
			.l-blue a { color: #6a7c96; }
			.l-blue1 a { color: #7abefa; }
			.l-blue2 a { color: #9eb8cc; }
	
	
		
			@media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {
				.mpy-35 { padding-top: 35px !important; padding-bottom: 35px !important; }
	
				.mpx-15 { padding-left: 15px !important; padding-right: 15px !important; }
	
				.mpx-20 { padding-left: 20px !important; padding-right: 20px !important; }
	
				.mpb-30 { padding-bottom: 30px !important; }
	
				.mpb-10 { padding-bottom: 10px !important; }
	
				.mpb-15 { padding-bottom: 15px !important; }
	
				.mpb-20 { padding-bottom: 20px !important; }
	
				.mpb-35 { padding-bottom: 35px !important; }
	
				.mpb-40 { padding-bottom: 40px !important; }
	
				.mpb-50 { padding-bottom: 50px !important; }
	
				.mpb-60 { padding-bottom: 60px !important; }
	
				.mpt-30 { padding-top: 30px !important; }
	
				.mpt-40 { padding-top: 40px !important; }
	
				.mpy-40 { padding-top: 40px !important; padding-bottom: 40px !important; }
	
				.mpt-0 { padding-top: 0px !important; }
	
				.mpr-0 { padding-right: 0px !important; }
	
				.mfz-14 { font-size: 14px !important; }
	
				.mfz-28 { font-size: 28px !important; }
	
				.mfz-16 { font-size: 16px !important; }
	
				.mfz-24 { font-size: 24px !important; }
	
				.mlh-18 { line-height: 18px !important; }
	
				u + body .gwfw { width:100% !important; width:100vw !important; }
	
				.td,
				.m-shell { width: 100% !important; min-width: 100% !important; }
	
				.mt-left { text-align: left !important; }
				.mt-center { text-align: center !important; }
				.mt-right { text-align: right !important; }
	
				.m-left { text-align: left !important; }
				.me-left { margin-right: auto !important; }
				.me-center { margin: 0 auto !important; }
				.me-right { margin-left: auto !important; }
	
				.mh-auto { height: auto !important; }
				.mw-auto { width: auto !important; }
	
				.fluid-img img { width: 100% !important; max-width: 100% !important; height: auto !important; }
	
				.column,
				.column-top,
				.column-dir,
				.column-dir-top { float: left !important; width: 100% !important; display: block !important; }
	
				.kmMobileStretch { float: left !important; width: 100% !important; display: block !important; padding-left: 0 !important; padding-right: 0 !important; }
	
				.m-hide { display: none !important; width: 0 !important; height: 0 !important; font-size: 0 !important; line-height: 0 !important; min-height: 0 !important; }
				.m-block { display: block !important; }
	
				.mw-15 { width: 15px !important; }
	
				.mw-2p { width: 2% !important; }
				.mw-32p { width: 32% !important; }
				.mw-49p { width: 49% !important; }
				.mw-50p { width: 50% !important; }
				.mw-100p { width: 100% !important; }
	
				.mbgs-200p { background-size: 200% auto !important; }
			}
		</style>
	<style type="text/css" id="operaUserStyle"></style><link href="chrome-extension://cmeakgjggjdlcpncigglobpjbkabhmjl/css/jquery-ui.css" rel="stylesheet" type="text/css"><style id="sih_highlight_styles" type="text/css">
		.sih_highlight_price {
		  display: inline-block;
		  padding: 1px 4px;
		  background-color: rgba(20,31,44,0.4) !important;
		  border-radius: 1px;
		}
		.sih_wishlist {
		  background-color: #29B6F6 !important;
		  background-image: linear-gradient(135deg, rgba(0, 0, 0, 0.3) 60%, rgba(0, 0, 0, 0.1) 90%) !important;
		}
		.sih_owned {
		  background-color: #9CCC65 !important;
		  background-image: linear-gradient(135deg, rgba(0, 0, 0, 0.3) 60%, rgba(0, 0, 0, 0.1) 90%) !important;
		}</style><link href="chrome-extension://cmeakgjggjdlcpncigglobpjbkabhmjl/js/siteExt/sihGlobalHeader.css" rel="stylesheet" type="text/css"></head>
	
	
	<body class="body" style="background: rgb(255, 255, 255); text-size-adjust: none; padding: 0px !important; margin: 0px auto !important; display: block !important; min-width: 100% !important; width: 100% !important;">
	<center>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin: 0; padding: 0; width: 100%; height: 100%;" bgcolor="#ffffff" class="gwfw">
			<tbody><tr>
				<td style="margin: 0; padding: 0; width: 100%; height: 100%;" align="center" valign="top">
					<table width="775" border="0" cellspacing="0" cellpadding="0" class="m-shell">
						<tbody><tr>
							<td class="td" style="width:775px; min-width:775px; font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<!-- Main -->
									<tbody><tr>
										<td class="p-80 mpy-35 mpx-15" bgcolor="#0f0d0f" style="padding: 80px;">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
	
												<!-- Logo -->
												<tbody><tr>
													<td class="img pb-45" style="font-size:0pt; line-height:0pt; text-align:left; padding-bottom: 45px;">
														<a href="https://goldentool.net" target="_blank">
															<img src="https://goldentool.net/main/logo-text.png" width="48" height="48" border="0" alt="Golden">
														</a>
	
													</td>
												</tr>
												<!-- END Logo -->
	
												<!-- All Content Exists within this table column -->
												<tr>
													<td>
	
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tbody><tr>
						<td class="title-36 pb-30 c-grey6 fw-b" style="font-size:36px; line-height:42px; font-family:Arial, sans-serif, &#39;Motiva Sans&#39;; text-align:left; padding-bottom: 30px; color:#bfbfbf; font-weight:bold;"><span style="color: #ffc107;">Hello '.$username.'!</span></td>
					</tr>
				</tbody></table>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tbody><tr>
						<td class="text-18 c-grey4 pb-30" style="font-size:18px; line-height:25px; font-family:Arial, sans-serif, &#39;Motiva Sans&#39;; text-align:left; color:#dbdbdb; padding-bottom: 30px;">You are receiving this because it looks like you want to set this email as your Golden account recovery.</td>
					</tr>
				</tbody></table>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tbody><tr>
						<td class="pb-70 mpb-50" style="padding-bottom: 70px;">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#17191c">
								<tbody><tr>
									<td class="py-30 px-56" style="padding-top: 30px; padding-bottom: 30px; padding-left: 56px; padding-right: 56px;">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
																						<tbody><tr>
													<td style="font-size:18px; line-height:25px; font-family:Arial, sans-serif, &#39;Motiva Sans&#39;; color:#8f98a0; text-align:center;">
														Request made from											</td>
												</tr>
												<tr>
													<td style="font-size:20px; line-height:30px; font-family:Arial, sans-serif, &#39;Motiva Sans&#39;; color:#f1f1f1; text-align:center;letter-spacing:1px">
														'.$country.'												</td>
												</tr>
												<tr>
													<td style="padding-bottom: 16px"></td>
												</tr>
																					<tr>
												<td class="title-48 c-blue1 fw-b a-center" style="font-size:48px; line-height:52px; font-family:Arial, sans-serif, &#39;Motiva Sans&#39;; color:#3a9aed; font-weight:bold; text-align:center;">
													<a href="https://dash.goldentool.net/verify?code='.encryptAES($username,$key).'" style="color: #fff;box-shadow: none;display: inline-block;font-weight: 600;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;background-color: transparent;border: 1px solid #ffc107;padding: 0.75rem 1.75rem;font-size: 1rem;line-height: 1.5;border-radius: 0.375rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;text-decoration:none;" target="_blank">Verify Email</a>	
												
												
												</td>
											</tr>
										</tbody></table>
									</td>
								</tr>
							</tbody></table>
						</td>
					</tr>
				</tbody></table>
							
						</td>
					</tr>
				</tbody></table>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tbody><tr>
						<td class="title-36 pb-30 c-grey6 fw-b" style="font-size:30px; line-height:34px; font-family:Arial, sans-serif, &#39;Motiva Sans&#39;; text-align:left; padding-bottom: 20px; color:#bfbfbf; font-weight:bold;">If it wasn\'t you</td>
					</tr>
				</tbody></table>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tbody><tr>
						<td class="text-18 c-grey4 pb-30" style="font-size:18px; line-height:25px; font-family:Arial, sans-serif, &#39;Motiva Sans&#39;; text-align:left; color:#dbdbdb; padding-bottom: 30px;">
							If you are not trying to verify your email, ignore this message.</td>
					</tr>
				</tbody></table>
												 <!-- Signature -->
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tbody><tr>
															<td class="pt-30" style="padding-top: 30px;">
																<table width="100%" border="0" cellspacing="0" cellpadding="0">
																	<tbody><tr>
																		<td class="img" width="3" bgcolor="#ffc107" style="font-size:0pt; line-height:0pt; text-align:left;"></td>
																		<td class="img" width="37" style="font-size:0pt; line-height:0pt; text-align:left;"></td>
																		<td>
																			<table width="100%" border="0" cellspacing="0" cellpadding="0">
																				<tbody><tr>
																																										<td class="text-16 py-20 c-grey4 fallback-font" style="font-size:16px; line-height:22px; font-family:Arial, sans-serif, &#39;Motiva Sans&#39;; text-align:left; padding-top: 20px; padding-bottom: 20px; color:#f1f1f1;">
																																											Best regards,<br>
	The Golden Team                                                                                  </td>
																																								</tr>
																																								
																			</tbody></table>
																		</td>
																		
																	</tr>
																	
																</tbody></table>
																
															</td>
															
														</tr>
													</tbody></table>
													<!-- END Signature -->
													
													</td>
												</tr>
	
											</tbody></table>
										</td>
									</tr>
									<!-- END Main -->
	
									<!-- Footer -->
									<tr>
										<td class="py-60 px-90 mpy-40 mpx-15" style="padding-top: 60px; padding-bottom: 60px; padding-left: 90px; padding-right: 90px;">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
	
																							<tbody><tr>
													<td class="text-18 pb-60 mpb-40 fallback-font" style="font-size:18px; line-height:25px; color:#000001; font-family:Arial, sans-serif, &#39;Motiva Sans&#39;; text-align:left; padding-bottom: 60px;">
														This notification has been sent to the email address associated with your Golden account.                                                  <br><br>
														This email is automatically generated. Please do not reply to it. If you need additional help, please contact Golden Support.                                              </td>
												</tr>
												
																							<!-- A -->
																							<tr>
												<td class="pb-60" style="padding-bottom: 60px;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tbody><tr>
															<th class="column" width="270" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
															   
															</th>
																												</tr>
													</tbody></table>
												</td>
												</tr>
												
	
							 
	
												
	
											</tbody></table>
										</td>
									</tr>
								<!-- END Footer -->
								</tbody></table>
							</td>
						</tr>
					</tbody></table>
				</td>
			</tr>
		</tbody></table>
	</center>
	
	
	
	
	</body></html>';
	$headers = "From: admin@goldentool.net\r\n";
	$headers .= "Reply-To: admin@goldentool.net\r\n";
	$headers .= "CC: admin@goldentool.net\r\n";
	$headers .= "BCC: admin@goldentool.net\r\n";
	$headers .= "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";

mail($to,$subject,$message,$headers);
echo 'success';
exit;

}


$rJson = file_get_contents("https://keyauth.win/api/1.2/?type=fetchStats&name=Golden&ownerid=Om54dY18BX&sessionid=".$_SESSION['sessionid'] );
$stats = json_decode($rJson,true);
$numUsers = $stats['appinfo']['numUsers'];

$numDownloads = "";
$numScans = "";
$numPIN = "";





$contenido = file_get_contents('stats.txt');

// Divide la cadena en partes por espacios en blanco
$partes = explode("\n", $contenido);

foreach ($partes as $parte) {

   	 $etiquetaNumero = explode("-", $parte);

        $etiqueta = $etiquetaNumero[0];
        $numero = $etiquetaNumero[1];

		if ($etiqueta == "Downloads") {
			$numDownloads = $numero;
		}
		
		if ($etiqueta == "Scans") {
			$numScans = $numero;
		}
		
		if ($etiqueta == "Pins Generated") {
			$numPIN = $numero;
		}
    
}





if (empty($DATA->subscriptions[0]->subscription)) {
	$subscription = "User";
} else {
$subscription = $DATA->subscriptions[0]->subscription;
}

if (strpos($subscription, "default") !== false) {
	$subscription = "Default";
}

$subscriptions = $_SESSION["user_data"]["subscriptions"];
$expiry = $_SESSION["user_data"]["subscriptions"][0]->expiry;

function obtenerCodigoPais($pais) {
    // Obtener el contenido del archivo JSON con los códigos de país
    $jsonData = file_get_contents('https://flagcdn.com/en/codes.json');

    if ($jsonData) {
        // Decodificar el JSON
        $countryCodes = json_decode($jsonData, true);

        // Buscar el código de país correspondiente al nombre proporcionado
        foreach ($countryCodes as $code => $countryName) {
            if (strtolower($countryName) === strtolower($pais)) {
                return strtoupper($code);
            }
        }
    }

    // Devuelve un valor vacío si no se pudo encontrar el código de país
    return '';
}

$foundemail = false;
$foundverify = false;

$respJson = file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=getvar&user=" . $username."&var=email" );
$mail = json_decode($respJson);

$respJson = file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=getvar&user=" . $username."&var=verified" );
$verify = json_decode($respJson);


    if ($verify->response === 'true') {
		$foundverify = true;
    }

	if ($mail->success=== true) {
	if ($mail->response !== '') {
		$foundemail = true;
    }
}



if ($foundemail === false) {
	echo '
	<div id="loading-screen">
			<a class="sidebar-brand">
			  <span class="align-middle"><img src="img/icons/icon-48x48.png"> | Dashboard</span>
			</a>
			<h4 id="status">You need to set up a recovery mail for your account</h4>
			<a>This will allow you to recover your account in case you forget your password.</a>
			<input type="text" class="form-control" id="Email" style="height:10px;margin-top:25px;width:220px;" placeholder="Enter your mail">
			<input type="text" class="form-control" id="confirmEmail" style="height:10px;margin-top:10px;width:220px;" placeholder="Confirm your mail">
			<button class="create-btn" style="padding:3px;width:220px;background-color: #ffbf00;border-color: #ffbf00;color:black;margin-top: 15px;height:30px"><i class="las la-certificate me-2"></i>Verify</button>
			<div class="spinner" id="spinn" style="scale:60%;display:none;margin-top:25px;"></div>
			<script>
	const ettons = document.querySelectorAll(".create-btn");
	ettons.forEach(button => {
		button.addEventListener("click", function() {
			const inputEName= document.getElementById("Email");
			const email = inputEName.value;
			const loadingScreen = document.getElementById("spinn");
			loadingScreen.style.display = "inline-flex";
			
			const formData = new FormData();
			formData.append("addEmail", email);
	
			const url = "dashboard.php"; 
	  fetch(url, {
				method: "POST",
				body: formData,
				credentials: "include",
			})
			.then(response => {
				if (!response.ok) {
					throw new Error("Error de red.");
				}
				return response.text();
			})
			.then((data) => {
				
				if (data.includes("success")) {
					var notyf = new Notyf();
					notyf.success("Check your inbox (and spam folder) to finish the verification");
					loadingScreen.style.display = "none";
				}
	
					if (data.includes("alreadyExists")) {
					var notyf = new Notyf();
					notyf.error("Email already in use!");
				}
			})
		});
	});
	</script>
		</div>
	';
	
}

	
?>


<div id="content">
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
          <span class="align-middle"><img src="img/icons/icon-48x48.png" /> | Dashboard</span>
        </a>

		<ul class="sidebar-nav">
					<li class="sidebar-header">
						General
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="./dashboard.php">
              <i class="align-middle"></i> <span class="align-middle"><i class="las la-sliders-h"></i>Overview</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="./scans.php">
              <i class="align-middle"></i> <span class="align-middle"><i class="las la-search"></i>Scans</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="./profile.php">
              <i class="align-middle" ></i> <span class="align-middle"><i class="lar la-user"></i>Profile</span>
            </a>
					</li>

					<?php 
					if (strstr($subscription, "Default") !== false) {

						echo "
						
						<li class=\"sidebar-item\">
						<a class=\"sidebar-link\" href=\"./purchase.php\">
              <i class=\"align-middle\" ></i> <span class=\"align-middle\"><i class=\"las la-shopping-cart\"></i>Purchase</span>
            </a>
					</li>
						
						";

					} 
					?>
					

					<li class="sidebar-header">
						Tool
					</li>

					<?php 
					if (strstr($subscription, "Default") !== false) {

					}
					else
					{
						echo "
						<li class=\"sidebar-item\">
						<a class=\"sidebar-link\" href=\"./operations.php\">
              <i class=\"align-middle\"></i> <span class=\"align-middle\"><i class=\"las la-download\"></i>Operations</span>
            </a>
					</li>
					";
					}

	if (strstr($subscription, "Enterprise") !== false) {
						echo "
						<li class=\"sidebar-item\">
						<a class=\"sidebar-link\" href=\"./enterprise.php\">
              <i class=\"align-middle\"></i> <span class=\"align-middle\"><i class=\"las la-otter\"></i>Enterprise</span>
            </a>
					</li>
					";
					}

					?>
					<li class="sidebar-item">
						<a class="sidebar-link" href="https://goldentool.net/changelog" target="_blank">
              <i class="align-middle"></i> <span class="align-middle"><i class="las la-newspaper"></i>Changelog</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="./faq.php">
              <i class="align-middle"></i> <span class="align-middle"><i class="las la-comment-dots"></i>Faq</span>
            </a>
					</li>

					<?php
	if (strstr($subscription, "Administrator") !== false) {
		echo "
		<li class=\"sidebar-header\">
		Staff
	</li>
		<li class=\"sidebar-item\">
		<a class=\"sidebar-link\" href=\"./management.php\">
<i class=\"align-middle\"></i> <span class=\"align-middle\"><i class=\"las la-laptop-code\"></i>Admin Panel</span>
</a>
	</li>

	<li class=\"sidebar-item\">
		<a class=\"sidebar-link\" href=\"./log.php\">
<i class=\"align-middle\"></i> <span class=\"align-middle\"><i class=\"lab la-readme\"></i>Auditory Log</span>
</a>
	</li>
	";
	}
					?>
					
					

					<?php

if (strstr($subscription, "Default") !== false) {

	echo "</li>";
}
else
{
	if (strstr($subscription, "Enterprise Owner-") !== false) {
		echo "
		<li class=\"sidebar-item\">
		<a class=\"sidebar-link\" href=\"./referral.php\">
	<i class=\"align-middle\"></i> <span class=\"align-middle\"><i class=\"las la-money-bill\"></i>Referral</span>
	</a>
	</li>
	";
	}
	
	if (strstr($subscription, "Permanent") !== false) {
		echo "
		<li class=\"sidebar-item\">
		<a class=\"sidebar-link\" href=\"./referral.php\">
	<i class=\"align-middle\"></i> <span class=\"align-middle\"><i class=\"las la-money-bill\"></i>Referral</span>
	</a>
	</li>
	";
	}
	else
	{
		echo "</li>";
	}
}

					?>
					
					<li class="sidebar-header">
						Legal
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="https://goldentool.net/tos" target="_blank">
              <i class="align-middle"></i> <span class="align-middle"><i class="las la-balance-scale"></i>Terms of Service</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="https://goldentool.net/privacy" target="_blank">
              <i class="align-middle"></i> <span class="align-middle"><i class="las la-user-secret"></i>Privacy Policy</span>
            </a>
					</li>
					
				</ul>

			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						
						<li class="nav-item dropdown">

						<a>Logged in as<a class="nav-link d-sm-inline-block" href="#" data-bs-toggle="dropdown" style="color:white;"><?php echo $username;?><i class="las la-angle-down ms-1"></i></a></a>
         
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<div class="dropdown-divider"></div>
								<form method="post">
								<button name="logout" class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="log-out"></i>Log out</a>
								</form>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<?php
if (!$foundverify) {
	echo '<div class="col-sm-12 col-md-12">
	<div class="alert alert-danger alert-dismissible" role="alert">
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

											<div class="alert-message">
											<i class="las la-bell"></i><strong>Hello there!</strong> You need to verify your email! Check your inbox and spam folder
											</div>
										</div>
	</div>';
}
?>
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h4 mb-3"><strong>Overview</strong> | <?php 
					
					if (strstr($subscription, "-") !== false) {
						$partes = explode("-", $subscription);
						
						if (count($partes) > 1) {
							$textoDespuesDelGuion = $partes[1];

							echo $textoDespuesDelGuion ." - " . $partes[0];
						}
					}
					else
					{
						echo $subscription;
					}
?></h1>


					<div class="row">
									<div class="col-sm-6">
										<div class="card" style="scale:80%;background-color:rgb(15, 13, 15);">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Downloads</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="truck"></i>
														</div>
													</div>
												</div>
												<h2 class="mt-1 mb-3"><?php echo $numDownloads;?></h2>
												<div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.25% </span>
													<span class="text-muted">Since last week</span>
												</div>
											</div>
										</div>
										<div class="card" style="scale:80%;background-color:rgb(15, 13, 15);">
											<div class="card-body" style="width: 300px; margin-left:15px;">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Scans</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h2 class="mt-1 mb-3"><?php echo $numScans;?></h2>
												<div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 2.21% </span>
													<span class="text-muted">Since last week</span>
												</div>
											</div>
										</div>

										<div class="card" style="scale:80%;background-color:rgb(15, 13, 15);">
											<div class="card-body" style="width: 300px; margin-left:15px;">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Detections</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h2 class="mt-1 mb-3">8.234</h2>
												<div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 4.72% </span>
													<span class="text-muted">Since last week</span>
												</div>
											</div>
										</div>

										<div class="card" style="scale:80%;background-color:rgb(15, 13, 15);">
											<div class="card-body" style="width: 300px; margin-left:15px;">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Users</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h2 class="mt-1 mb-3"><?php echo $numUsers;?></h2>
												<div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>6.39% </span>
													<span class="text-muted">Since last week</span>
												</div>
											</div>
										</div>
										<div class="card" style="scale:80%;background-color:rgb(15, 13, 15);" >
											<div class="card-body" style="width: 300px; margin-left:15px;">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Pins Generated</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h2 class="mt-1 mb-3"><?php echo $numPIN;?></h2>
												<div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 7.34% </span>
													<span class="text-muted">Since last week</span>
												</div>
											</div>
										</div>
									</div>
					

					</div>

					<div class="row">
						<div class="col-12 col-lg-8 col-xxl-9 d-flex">
							<div class="card flex-fill" >	
							<div class="card-body"style="background-color:rgb(15, 13, 15);">
                                  
							<div class="card-body p-0">
<div class="d-flex align-items-center px-3 px-md-4 py-3 border-bottom border-gray-200">
<h5 class="card-header-title mb-0 my-md-2 font-weight-semibold ps-md-3">Announcements</h5>
</div>
<div class="card-body px-md-4 py-0">
<div class="px-md-3">
<div class="media align-items-center border-bottom border-gray-200 py-3 py-md-4">
<span class="me-3">
<img class="avatar avatar-sm" style="border-radius: 50%;" src="https://cdn.discordapp.com/avatars/1145780955924140062/a285c1de428d1c80b5ddd7971e1e27d7.png?size=4096" alt="Icon" loading="lazy">
</span>
<div class="media-body">
<span class="fs-16 font-weight-semibold dropdown-title text-black-600">After a long time (and several cups of coffee) the dashboard update has been released, enjoy it!</span>
<span class="d-block small text-gray-600 mt-1 mt-md-2 dropdown-content" ><span class="admin-rank">notsnakesilent</span> - Update - October 29, 2023, 05:13 GMT</span>
</div>
</div>
</div>
</div>
</div>
							
							</div>
							
							</div>
							
							

						</div>

						<div class="col-12 col-lg-4 col-xxl-3 d-flex">
					     <div class="card flex-fill w-100">
							<div class="card flex-fill" >
							 <div class="card-body"style="background-color:rgb(15, 13, 15);">
                                  <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                      <h4 class="card-title card-title-dash">Stadistics</h4>
                                     <p class="card-subtitle card-subtitle-dash">See global Golden stadistics</p>
                                    </div>
                                  </div>
								
							

								  <ul class="timeline mt-2 mb-0">
										<li class="timeline-item">
											<strong>Top country detections</strong>
											<div style="height:10px"></div>

											<?php
											$resultadoArchivo = 'countrys.txt';

											if (file_exists($resultadoArchivo)) {
												$lines = file($resultadoArchivo, FILE_IGNORE_NEW_LINES);
											
												// Inicializar un arreglo asociativo para almacenar los conteos de países
												$conteosPaises = [];
											
												foreach ($lines as $line) {
													// Dividir cada línea en país y conteo
													list($pais, $conteo) = explode(', ', $line);
											
													// Eliminar "País: " y "Conteo: " del valor
													$pais = str_replace('País: ', '', $pais);
													$conteo = str_replace('Conteo: ', '', $conteo);
											
													// Almacenar el conteo en el arreglo
													$conteosPaises[$pais] = $conteo;
												}
											} else {
												// Si el archivo no existe, inicializar el arreglo de conteos de países
												$conteosPaises = [];
											}
											
											// Ordenar los países de mayor a menor conteo
											arsort($conteosPaises);
											
											// Obtener las 5 primeras países con sus valores
											$primeros5Paises = array_slice($conteosPaises, 0, 5);
											
											// Mostrar las 5 primeras países con sus valores
											foreach ($primeros5Paises as $pais => $conteo) {
												if ($conteo > 0) {
													// Aquí debes obtener el código de país cca2 utilizando la API o fuente de datos


													if($pais == "United States Of America")
													{
														$pais = "United States";
														echo '<p><img src="https://flagsapi.com/US/flat/16.png" style="border-radius: 20px;"><strong> ' . $pais . '</strong> ' . $conteo . ' Detections</p>';
													}
													else
													{

												
													$codigoPais = obtenerCodigoPais($pais); 
											
													if ($codigoPais) {
														// Mostrar la bandera y el país
														echo '<p><img src="https://flagsapi.com/' . $codigoPais . '/flat/16.png" style="border-radius: 20px;"><strong> ' . $pais . '</strong> ' . $conteo . ' Detections</p>';
													} else {
														// Mostrar solo el país sin la bandera si no se encuentra el código
														echo '<p><strong>' . $pais . '</strong> ' . $conteo . ' Detections</p>';
													}
												}
												}
											}
											
											
											?>
											
										</li>
										<li class="timeline-item">
											<strong>Most popular cheats found</strong>
											<div style="height:10px"></div>
											<?php
											
											$resultadoArchivo = 'resultados.txt';

											if (file_exists($resultadoArchivo)) {
												$lines = file($resultadoArchivo, FILE_IGNORE_NEW_LINES);
											
												foreach ($lines as $line) {
													// Dividir cada línea en palabra y conteo
													list($palabra, $conteo) = explode(', ', $line);
											
													// Eliminar "Palabra: " y "Conteo: " del valor
													$palabra = str_replace('Palabra: ', '', $palabra);
													$conteo = str_replace('Conteo: ', '', $conteo);
											
													// Almacenar el conteo en el arreglo
													$variablesConValores[$palabra] = $conteo;
												}
											}
											
											// Ordenar las variables de mayor a menor
											arsort($variablesConValores);
											
											// Obtener las 5 primeras variables con sus valores
											$primeras5 = array_slice($variablesConValores, 0, 5);
											
											// Mostrar las 5 primeras variables con sus valores
											foreach ($primeras5 as $variable => $valor) {
												if ($valor > 0) {

													
													$variable = str_replace("dream", "Dream", $variable);
													$variable = str_replace("entropy", "Entropy", $variable);
													$variable = str_replace("gosth", "Gosth", $variable);
												 $variable = str_replace("skript", "Skript", $variable);
													$variable = str_replace("eulen", "Eulen", $variable);
													$variable = str_replace("vape", "Vape", $variable);  $variable = str_replace("dream", "Dream", $variable);
													$variable = str_replace("redengine", "RedEngine", $variable);
													$variable = str_replace("degeo", "Degeo", $variable);  $variable = str_replace("dream", "Dream", $variable);
													$variable = str_replace("tzproject", "TZProject", $variable);
													$variable = str_replace("susano", "Susano", $variable);
												 $variable = str_replace("drip", "Drip", $variable);
													$variable = str_replace("karma", "Karma", $variable);
													$variable = str_replace("hx software", "HX Software", $variable);

													echo '<p><img src="https://dash.goldentool.net/cheats/' . $variable . '.png" style="width:16px; height:16px; border-radius: 20px; margin-right: 5px;"><strong>' . $variable . ' Client</strong> Found ' . $valor . ' times</p>';
												}
											}
											
											?>
										
										</li>
									</ul>
							
							</div>
						</div>
					</div>
					<div>

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
							<a class="text-muted">© 2023 </a><a class="text-muted" href="https://goldentool.net" target="_blank"><strong>Golden Solutions LLC</strong></a><a class="text-muted">. All rights reserved</a>
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
</div>
	<script src="js/app.js"></script>

<?php
/*
$context = stream_context_create([
		'http' => ['ignore_errors' => true],
	]);
	
	$storedISP = file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=getvar&user=" . $username . "&var=ISP", false, $context);
	
	if (strpos($http_response_header[0], '404') !== false) {

		$ISPJson = file_get_contents("http://ip-api.com/json/".$_SERVER["HTTP_CF_CONNECTING_IP"]."?fields=isp");
		$ISPDATA = json_decode($ISPJson);


	file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=setvar&user=" . $username ."&var=ipAddress&data=". $_SERVER["HTTP_CF_CONNECTING_IP"]);
	file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=setvar&user=" . $username ."&var=ISP&data=". $ISPDATA->isp);

	}
	else
	{
		$storedISPDATA = json_decode($storedISP);
		
		$IpJson = file_get_contents("http://ip-api.com/json/".$_SERVER["HTTP_CF_CONNECTING_IP"]."?fields=isp");
		$IPDATA = json_decode($IpJson);



		if ($IPDATA->isp ==$storedISPDATA) 
	    {
		
		}
		else
		{
			$webhookUrl = 'https://discord.com/api/webhooks/1166942708963758080/H7Q3-AL-sJnAwfYZl518-22kJQ1O9jNFa0-QvwRPhYyjNkcqxFWaZ0pN-jL44bGOdc1B';
		
		$data = array(
  "content" => "@everyone",
  "embeds" => array(
    array(
      "color" => 16774400,
      "fields" => array(
        array(
          "name" => "Username",
          "value" => $username
        ),
        array(
          "name" => "Stored ISP",
          "value" => $storedISPDATA->response
        ),
        array(
          "name" => "New ISP",
          "value" => $IPDATA->isp
        ),
        array(
          "name" => "IP Address",
          "value" => $_SERVER["HTTP_CF_CONNECTING_IP"]
        ) 
      ),
      "author" => array(
        "name" => "Detected possible account sharing"
      )
    )
  ),
  "attachments" => array()
);

		
		
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
		
		
		}
		

	file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=setvar&user=" . $username ."&var=ipAddress&data=". $_SERVER["HTTP_CF_CONNECTING_IP"]);
	file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=setvar&user=" . $username ."&var=ISP&data=". $storedISPDATA);
		
		
	}





	
*/
?>
	
	

</body>

</html>
