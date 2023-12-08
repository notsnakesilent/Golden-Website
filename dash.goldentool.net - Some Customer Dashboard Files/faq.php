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
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Effective and accurate screenshare solutions">
	<script src="https://cdn.keyauth.uk/dashboard/unixtolocal.js"></script>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="./img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Golden - Faq</title>

	<link href="./app.css" rel="stylesheet">
	<link href="./style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
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

					if (strstr($subscription, "-") !== false) {
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

					<li class="sidebar-item active">
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
				<h1 class="h4 mb-3"><strong>Faq</strong> | <?php 
					
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
						<div class="col-12 d-flex" style="">
							<div class="card" >
							<div class="card-body"style="background-color:rgb(15, 13, 15);">
                               

									<div class="row">
										<div class="col mt-0">
											<h4 class="card-title">How do I use the tool?</h4>
											<a>It's as simple as generating your scan link, copy, send, then determine the player's veredict.</a>
										</div>

										<div class="col mt-0">
											<h4 class="card-title">What does the "In Instance" mean?</h4>
											<a>In Instance flags occur when a cheat has been used within the current Game instance.</a>
										</div>

										<div class="col mt-0">
											<h4 class="card-title">What does the "Out of Instance" mean?</h4>
											<a>Out of Instance flags occur when a cheat has been executed after the user's computer was started.</a>
										</div>

										<div class="col mt-0">
											<h4 class="card-title">With what is Golden compatible?</h4>
											<a>We offer support for Windows 7-11 64-bit (And attenuated versions like MiniOS , ReviOS, etc), Minecraft 1.7.10-1.18, Bedrock , FiveM, Rust and Roblox.</a>
										</div>

										<div class="col mt-0">
											<h4 class="card-title">I believe i found a false positive/bypass, what do I do?</h4>
											<a>Contact our 24/7 support team via Discord, U will need to provide the scan link. We’ll investigate any potential issues and resolve them accordingly.</a>
										</div>
									</div>

									<div class="row" style="MARGIN-TOP:20PX;">
										<div class="col mt-0">
											<h4 class="card-title">May I share my account or scans?</h4>
											<a>Unfortunately sharing your details or scan links is strictly against our terms of service, and commonly results in a permanent suspension of service.</a>
										</div>

										<div class="col mt-0">
											<h4 class="card-title">What type of data is logged?</h4>
											<a>Read our privacy policy @ https://goldentool.net/privacy for detailed information.</a>
										</div>

										<div class="col mt-0">
											<h4 class="card-title">I own a large network, how may i apply for a partnership?</h4>
											<a>Contact our 24/7 support team via Discord.</a>
										</div>

										<div class="col mt-0">
											<h4 class="card-title"></h4>
											<a></a>
										</div>

										<div class="col mt-0">
											<h4 class="card-title"></h4>
											<a></a>
										</div>
									</div>

                                </div>
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
