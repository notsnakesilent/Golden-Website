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

$url = "your API";

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
$respJson = file_get_contents("Your API");
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

	<title>Golden - Profile</title>

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

					<li class="sidebar-item active">
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

				<h1 class="h4 mb-3"><strong>Profile</strong> | <?php 
					
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

						<div class="col-md-3 col-xl-2">

							<div class="card">
								<div class="card-header">
								</div>

								<div class="list-group list-group-flush" role="tablist">
									<a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab" aria-selected="true">
										Account
									</a>
								</div>
							</div>
						</div>

						<div class="col-md-9 col-xl-10">
							<div class="tab-content">
								<div class="tab-pane fade active show" id="account" role="tabpanel">

									<div class="card">
										<div class="card-header">

											<h5 class="card-title mb-0">General info</h5>
										</div>
										<div class="card-body">
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<label class="form-label" for="inputUsername">Username</label>
															<a style="margin-left:37px"><?php echo $username;?></a>
														</div>
														<div class="mb-3">
														<label class="form-label" for="inputUsername">Subscription</label>
														<?php

						echo "<a style=\"margin-left:20px\">".$subscription;
	echo "</a>
	</div>";

		for ($i = 0; $i < count($subscriptions); $i++) {
														echo "<div class=\"mb-3\">
														<label class=\"form-label\" for=\"inputUsername\">Expires</label>
														<a style=\"margin-left:60px\"><script>document.write(convertTimestamp(" . $subscriptions[$i]->expiry . "));</script></a></div>
		";
    }
    ?>
														</div>
													</div>

												</div>

										</div>
									</div>

								</div>
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

	<script src="js/app.js"></script>


	
	
	
	

</body>

</html>
