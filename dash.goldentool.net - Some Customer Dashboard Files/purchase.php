<?php
include './credentials.php';
require './keyauth.php';

function errorHandler($errno, $errstr, $errfile, $errline) {
		echo "<meta http-equiv='Refresh' Content='2; url=501.html'>";
    exit();
}

set_error_handler('errorHandler');


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


if (isset($_POST['redeem'])) {
	$key= $_POST['redeem'];

$headers = get_headers("https://keyauth.win/api/seller/?sellerkey=" . $sellerkey . "&type=verify&key=" . $key, 1);

// Verificar el código de estado de la respuesta HTTP
if (isset($headers[0]) && strpos($headers[0], "406 Not Acceptable") !== false) {
		echo "invalidKey";
		exit;
} else {

	$respJson = file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=userdata&user=" . $username );
	$SEX = json_decode($respJson);
	
		$subscription = $SEX->subscriptions[0]->subscription;

		if (strstr($subscription, "-") !== false) {
		echo "alreadyMember";
		exit;
		}

		if (strstr($subscription, "Customer") !== false) {
		echo "alreadyMember";
		exit;
		}

	$respJson = file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=info&key=" . $key);
	$SEX = json_decode($respJson);

	$level = $SEX->level;
	if (strstr($level, "2") !== false) {
		file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=delsub&user=" . $username ."&sub=default");		
		file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=extend&user=" .$username ."&sub=Customer Monthly". "&expiry=30");	
	}
	if (strstr($level, "3") !== false) {
		file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=delsub&user=" . $username ."&sub=default");		
		file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=extend&user=" .$username ."&sub=Customer Permanent". "&expiry=99999999999");	
	}
	if (strstr($level, "5") !== false) {
		file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=delsub&user=" . $username ."&sub=default");		
		file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=extend&user=" .$username ."&sub=Enterprise". "&expiry=365");	
	}

	$respJson = file_get_contents("https://keyauth.win/api/seller/?sellerkey=". $sellerkey."&type=del&key=" . $key."&=userToo0" );
	$SEX = json_decode($respJson);
	echo "success";
	exit;

}



	
		
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Effective and accurate screenshare solutions">
	<script src="https://cdn.keyauth.uk/dashboard/unixtolocal.js"></script>
	<script src="https://cdn.sellix.io/static/js/embed.js"></script>
    <link href="https://cdn.sellix.io/static/css/embed.css" rel="stylesheet"/>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="./img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Golden - Purchase</title>

	<link href="./app.css" rel="stylesheet">
	<link href="./style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
	<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

	<script>
    
 window.addEventListener('load', () => {
    const loadingScreen = document.getElementById('loading-screen');
    loadingScreen.style.display = 'none';

    const content = document.getElementById('wrapper');
    content.style.display = 'block';
});
	</script>
</head>

<body>
<div id="loading-screen">
		<a class="sidebar-brand">
          <span class="align-middle"><img src="img/icons/icon-48x48.png"> | Dashboard</span>
        </a>
        <div class="spinner" style="scale:80%;"></div>
		<h4 id="status" style="padding-top:40px;"></h4>
    </div>
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

					<li class="sidebar-item">
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
						
						<li class=\"sidebar-item active\">
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

					
					<li class="sidebar-header">
						Customization
					</li>

					<?php 
					if (strstr($subscription, "Default") !== false) {

					}
					else
					{
						echo "
						<li class=\"sidebar-item\">
						<a class=\"sidebar-link\" href=\"./strings.php\">
              <i class=\"align-middle\"></i> <span class=\"align-middle\"><i class=\"las la-feather-alt\"></i>Custom Strings</span>
            </a>
					</li>
					";
					echo "
					<li class=\"sidebar-item\">
					<a class=\"sidebar-link\" href=\"./gui.php\">
		  <i class=\"align-middle\"></i> <span class=\"align-middle\"><i class=\"las la-window-restore\"></i>Custom GUI</span>
		</a>
				</li>
				";
					}

		

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
						<div class="col-12 d-flex" style="justify-content: center; text-align: center;">
							<div class="card" style="align-items: center;">
							<div class="card-body"style="background-color:rgb(15, 13, 15);">
                               

									<div class="row">
										<div class="col mt-0">
											<h4 class="card-title">Purchase Golden</h4>
										</div>

									</div>

									<div class="row justify-content-center" bis_size="{&quot;x&quot;:362,&quot;y&quot;:4626,&quot;w&quot;:1140,&quot;h&quot;:547,&quot;abs_x&quot;:362,&quot;abs_y&quot;:4686}"><div class="col-lg-4 col-md" bis_size="{&quot;x&quot;:552,&quot;y&quot;:4626,&quot;w&quot;:379,&quot;h&quot;:547,&quot;abs_x&quot;:552,&quot;abs_y&quot;:4686}"><div class="card card-pricing text-center px-3 hover-scale-110" bis_size="{&quot;x&quot;:567,&quot;y&quot;:4626,&quot;w&quot;:349,&quot;h&quot;:479,&quot;abs_x&quot;:567,&quot;abs_y&quot;:4686}"><div class="card-header py-5 border-0 delimiter-bottom" bis_size="{&quot;x&quot;:584,&quot;y&quot;:4627,&quot;w&quot;:315,&quot;h&quot;:183,&quot;abs_x&quot;:584,&quot;abs_y&quot;:4687}"><div class="h1 text-center mb-0" bis_size="{&quot;x&quot;:612,&quot;y&quot;:4675,&quot;w&quot;:259,&quot;h&quot;:60,&quot;abs_x&quot;:612,&quot;abs_y&quot;:4735}" style="font-size: 2.4rem; COLOR: var(--bs-body-color);">$<span class="price font-weight-bolder" bis_size="{&quot;x&quot;:730,&quot;y&quot;:4678,&quot;w&quot;:48,&quot;h&quot;:54,&quot;abs_x&quot;:730,&quot;abs_y&quot;:4738}">8.99</span></div><span class="h6 text-muted" bis_size="{&quot;x&quot;:679,&quot;y&quot;:4737,&quot;w&quot;:125,&quot;h&quot;:22,&quot;abs_x&quot;:679,&quot;abs_y&quot;:4797}" style="top:5px; position:relative;">Standard License</span></div><div class="card-body" bis_size="{&quot;x&quot;:584,&quot;y&quot;:4810,&quot;w&quot;:315,&quot;h&quot;:294,&quot;abs_x&quot;:584,&quot;abs_y&quot;:4870}"><ul class="list-unstyled text-sm mb-4" bis_size="{&quot;x&quot;:612,&quot;y&quot;:4838,&quot;w&quot;:259,&quot;h&quot;:159,&quot;abs_x&quot;:612,&quot;abs_y&quot;:4898}"><li bis_size="{&quot;x&quot;:612,&quot;y&quot;:4838,&quot;w&quot;:259,&quot;h&quot;:39,&quot;abs_x&quot;:612,&quot;abs_y&quot;:4898}">1 Monthly License</li><li bis_size="{&quot;x&quot;:612,&quot;y&quot;:4877,&quot;w&quot;:259,&quot;h&quot;:39,&quot;abs_x&quot;:612,&quot;abs_y&quot;:4937}">Unlimited Scans</li>
<li bis_size="{&quot;x&quot;:612,&quot;y&quot;:4877,&quot;w&quot;:259,&quot;h&quot;:39,&quot;abs_x&quot;:612,&quot;abs_y&quot;:4937}">Personal Use</li><li bis_size="{&quot;x&quot;:612,&quot;y&quot;:4917,&quot;w&quot;:259,&quot;h&quot;:39,&quot;abs_x&quot;:612,&quot;abs_y&quot;:4977}">Continuous Updates</li><li bis_size="{&quot;x&quot;:612,&quot;y&quot;:4957,&quot;w&quot;:259,&quot;h&quot;:39,&quot;abs_x&quot;:612,&quot;abs_y&quot;:5017}">24/7 Support</li></ul>
<a data-sellix-product="65176038044f4" class="btn btn-sm btn-warning hover-translate-y-n3 hover-shadow-lg mb-3" target="_blank" bis_size="{&quot;x&quot;:676,&quot;y&quot;:5021,&quot;w&quot;:131,&quot;h&quot;:39,&quot;abs_x&quot;:676,&quot;abs_y&quot;:5081}">Purchase now</a>
</div></div></div><div class="col-lg-4 col-md" bis_size="{&quot;x&quot;:932,&quot;y&quot;:4626,&quot;w&quot;:379,&quot;h&quot;:547,&quot;abs_x&quot;:932,&quot;abs_y&quot;:4686}"><div class="card card-pricing text-center px-3 hover-scale-110" bis_size="{&quot;x&quot;:947,&quot;y&quot;:4626,&quot;w&quot;:349,&quot;h&quot;:517,&quot;abs_x&quot;:947,&quot;abs_y&quot;:4686}"><div class="card-header py-5 border-0 delimiter-bottom" bis_size="{&quot;x&quot;:963,&quot;y&quot;:4626,&quot;w&quot;:317,&quot;h&quot;:183,&quot;abs_x&quot;:963,&quot;abs_y&quot;:4686}"><div class="h1 text-white text-center mb-0" bis_size="{&quot;x&quot;:991,&quot;y&quot;:4674,&quot;w&quot;:261,&quot;h&quot;:60,&quot;abs_x&quot;:991,&quot;abs_y&quot;:4734}"  style="font-size: 2.4rem;">$<span class="price font-weight-bolder" bis_size="{&quot;x&quot;:1097,&quot;y&quot;:4677,&quot;w&quot;:72,&quot;h&quot;:54,&quot;abs_x&quot;:1097,&quot;abs_y&quot;:4737}">19.99</span></div><span class="h6 text-white" bis_size="{&quot;x&quot;:1058,&quot;y&quot;:4736,&quot;w&quot;:127,&quot;h&quot;:22,&quot;abs_x&quot;:1058,&quot;abs_y&quot;:4796}" style="top:5px; position:relative;">Extended License</span></div><div class="card-body" bis_size="{&quot;x&quot;:963,&quot;y&quot;:4809,&quot;w&quot;:317,&quot;h&quot;:333,&quot;abs_x&quot;:963,&quot;abs_y&quot;:4869}"><ul class="list-unstyled text-white text-sm opacity-8 mb-4" bis_size="{&quot;x&quot;:991,&quot;y&quot;:4837,&quot;w&quot;:261,&quot;h&quot;:198,&quot;abs_x&quot;:991,&quot;abs_y&quot;:4897}"><li bis_size="{&quot;x&quot;:991,&quot;y&quot;:4837,&quot;w&quot;:261,&quot;h&quot;:39,&quot;abs_x&quot;:991,&quot;abs_y&quot;:4897}">1 Lifetime License</li><li bis_size="{&quot;x&quot;:991,&quot;y&quot;:4876,&quot;w&quot;:261,&quot;h&quot;:39,&quot;abs_x&quot;:991,&quot;abs_y&quot;:4936}">Unlimited Scans</li>

<li bis_size="{&quot;x&quot;:612,&quot;y&quot;:4877,&quot;w&quot;:259,&quot;h&quot;:39,&quot;abs_x&quot;:612,&quot;abs_y&quot;:4937}">Personal Use</li><li bis_size="{&quot;x&quot;:991,&quot;y&quot;:4916,&quot;w&quot;:261,&quot;h&quot;:39,&quot;abs_x&quot;:991,&quot;abs_y&quot;:4976}">Continuous Updates</li><li bis_size="{&quot;x&quot;:991,&quot;y&quot;:4996,&quot;w&quot;:261,&quot;h&quot;:39,&quot;abs_x&quot;:991,&quot;abs_y&quot;:5056}">24/7 Support</li></ul>
<a data-sellix-product="65242f34128cf" class="btn btn-sm btn-warning hover-translate-y-n3 hover-shadow-lg mb-3" target="_blank" bis_size="{&quot;x&quot;:676,&quot;y&quot;:5021,&quot;w&quot;:131,&quot;h&quot;:39,&quot;abs_x&quot;:676,&quot;abs_y&quot;:5081}">Purchase now</a>
</div></div></div>

<div class="col-lg-4 col-md" bis_size="{&quot;x&quot;:552,&quot;y&quot;:4626,&quot;w&quot;:379,&quot;h&quot;:547,&quot;abs_x&quot;:552,&quot;abs_y&quot;:4686}"><div class="card card-pricing text-center px-3 hover-scale-110" bis_size="{&quot;x&quot;:567,&quot;y&quot;:4626,&quot;w&quot;:349,&quot;h&quot;:479,&quot;abs_x&quot;:567,&quot;abs_y&quot;:4686}"><div class="card-header py-5 border-0 delimiter-bottom" bis_size="{&quot;x&quot;:584,&quot;y&quot;:4627,&quot;w&quot;:315,&quot;h&quot;:183,&quot;abs_x&quot;:584,&quot;abs_y&quot;:4687}"><div class="h1 text-center mb-0" bis_size="{&quot;x&quot;:612,&quot;y&quot;:4675,&quot;w&quot;:259,&quot;h&quot;:60,&quot;abs_x&quot;:612,&quot;abs_y&quot;:4735}" style="font-size: 2.4rem; COLOR: var(--bs-body-color);">$<span class="price font-weight-bolder" bis_size="{&quot;x&quot;:730,&quot;y&quot;:4678,&quot;w&quot;:48,&quot;h&quot;:54,&quot;abs_x&quot;:730,&quot;abs_y&quot;:4738}">49.99</span></div><span class="h6 text-muted" bis_size="{&quot;x&quot;:679,&quot;y&quot;:4737,&quot;w&quot;:125,&quot;h&quot;:22,&quot;abs_x&quot;:679,&quot;abs_y&quot;:4797}" style="top:5px; position:relative;">Enterprise License</span></div><div class="card-body" bis_size="{&quot;x&quot;:584,&quot;y&quot;:4810,&quot;w&quot;:315,&quot;h&quot;:294,&quot;abs_x&quot;:584,&quot;abs_y&quot;:4870}"><ul class="list-unstyled text-sm mb-4" bis_size="{&quot;x&quot;:612,&quot;y&quot;:4838,&quot;w&quot;:259,&quot;h&quot;:159,&quot;abs_x&quot;:612,&quot;abs_y&quot;:4898}"><li bis_size="{&quot;x&quot;:612,&quot;y&quot;:4838,&quot;w&quot;:259,&quot;h&quot;:39,&quot;abs_x&quot;:612,&quot;abs_y&quot;:4898}">1 Yearly License</li><li bis_size="{&quot;x&quot;:612,&quot;y&quot;:4877,&quot;w&quot;:259,&quot;h&quot;:39,&quot;abs_x&quot;:612,&quot;abs_y&quot;:4937}">Unlimited Scans</li>
<li bis_size="{&quot;x&quot;:612,&quot;y&quot;:4877,&quot;w&quot;:259,&quot;h&quot;:39,&quot;abs_x&quot;:612,&quot;abs_y&quot;:4937}">For 20 people</li><li bis_size="{&quot;x&quot;:612,&quot;y&quot;:4917,&quot;w&quot;:259,&quot;h&quot;:39,&quot;abs_x&quot;:612,&quot;abs_y&quot;:4977}">Continuous Updates</li><li bis_size="{&quot;x&quot;:612,&quot;y&quot;:4957,&quot;w&quot;:259,&quot;h&quot;:39,&quot;abs_x&quot;:612,&quot;abs_y&quot;:5017}">24/7 Support</li></ul>
<a data-sellix-product="65242f94e3a14" type="submit" class="btn btn-sm btn-warning hover-translate-y-n3 hover-shadow-lg mb-3" target="_blank" bis_size="{&quot;x&quot;:676,&quot;y&quot;:5021,&quot;w&quot;:131,&quot;h&quot;:39,&quot;abs_x&quot;:676,&quot;abs_y&quot;:5081}">Purchase now</a>
</div></div></div></div>	
                                </div>
								<h6 class="card-title" style="color:#9c9fa6;">Already purchased? Enter your key</h6>
		  <input type="text" class="form-control" id="key" style="height:10px;margin-top:5px;width:220px;">
								  <button class="create-btn" style="padding:3px;width:220px;background-color: #ffbf00;border-color: #ffbf00;color:black;margin-top: 15px;"><i class="las la-certificate me-2"></i>Redeem</button>
<br>

<div class="mt-4"></div>
<p>If you have Monthly License, you need to create a ticket in our Discord for access Customer Discord</p>
								  <script>
const ettons = document.querySelectorAll(".create-btn");
ettons.forEach(button => {
    button.addEventListener("click", function() {
		const inputKey= document.getElementById("key");
		const key = inputKey.value;
		const loadingScreen = document.getElementById('loading-screen');
		const statusH4 = document.getElementById('status');
		statusH4.textContent = "Redeeming your key";
    	loadingScreen.style.display = 'inline-flex';
		
        const formData = new FormData();
        formData.append("redeem", key);

        const url = "purchase.php"; 
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
			
			if (data.includes("invalidKey")) {
				var notyf = new Notyf();
				notyf.error('Key does not exist');
				loadingScreen.style.display = 'none';
			}

			if (data.includes("success")) {
				var notyf = new Notyf();
				notyf.success('Successfully redeemed your key');
				loadingScreen.style.display = 'none';
			}

			if (data.includes("alreadyMember")) {
				var notyf = new Notyf();
				notyf.error('You already have a license');
				loadingScreen.style.display = 'none';
			}
		})
    });
});
</script>
							</div>
							
						</div>
						
</div>


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

	<script src="js/app.js"></script>


	
	
	
	

</body>

</html>
