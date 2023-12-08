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
$respJson = file_get_contents("your API");
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

if (isset($_POST['setReferral'])) {

	$subscription = $DATA->subscriptions[0]->subscription;
	if (strpos($subscription, "Enterprise Owner") === false && strpos($subscription, "Customer") === false) {
echo "notAuthorized";
exit;
   }
   else
   {







	$code = $_POST['setReferral'];
	if (strlen($code) > 8) {
		echo "maxLenght";
		exit;
	}

	$context = stream_context_create([
		'http' => ['ignore_errors' => true],
	]);
	
	$content = file_get_contents("your api");
	
	if (strpos($http_response_header[0], '404') !== false) {


	if ("your API processing") {
		echo "success";
		exit;
	}
	else
	{
		echo "alreadyAdded";
		exit;
	}


	}
	else
	{
		echo "alreadyHave";
		exit;
	}
}
}

if (strpos($subscription, "Enterprise") === false && strpos($subscription, "Customer") === false) {
	echo "<meta http-equiv='Refresh' Content='2; url=403.html'>";
	exit;
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
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="./img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Golden - Referral</title>

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

					<li class="sidebar-item">
						<a class="sidebar-link" href="./faq.php">
              <i class="align-middle"></i> <span class="align-middle"><i class="las la-comment-dots"></i>Faq</span>
            </a>
					

					<?php

if (strstr($subscription, "Default") !== false) {

	echo "</li>";
}
else
{
	if (strstr($subscription, "Enterprise Owner-") !== false) {
		echo "
		<li class=\"sidebar-item active\">
		<a class=\"sidebar-link\" href=\"./referral.php\">
	<i class=\"align-middle\"></i> <span class=\"align-middle\"><i class=\"las la-money-bill\"></i>Referral</span>
	</a>
	</li>
	";
	}
	
	if (strstr($subscription, "Permanent") !== false) {
		echo "
		<li class=\"sidebar-item active\">
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

				<h1 class="h4 mb-3"><strong>Referral</strong> | <?php 
					
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
						
<?php

$context = stream_context_create([
    'http' => ['ignore_errors' => true],
]);

$content = file_get_contents("your API");

if (strpos($http_response_header[0], '404') !== false) {

	echo '	<div class="row">
	<div class="col-3 d-flex">
	<div class="card" >
	<div class="card-body"style="background-color:rgb(15, 13, 15);">
	<div class="d-sm-flex justify-content-between align-items-start">
		<div>
		  <h4 class="card-title card-title-dash">Referral Code</h4>
		 <p class="card-subtitle card-subtitle-dash">Here you can set your referral code</p>
		</div>
	 
	  </div>
	  <div class="mb-3">
		  <input type="text" class="form-control" id="referralCode" style="height:10px;" maxlength="8">
		  <button class="setStaff-btn">Set</button>

		  <script>
	  const enviarBu = document.querySelectorAll(".setStaff-btn");
	  enviarBu.forEach(button => {
		  button.addEventListener("click", function() {
			  const inputElement = document.getElementById("referralCode");
			  const sNick = inputElement.value.toUpperCase();
	  
			  const loadingScreen = document.getElementById("loading-screen");
			  const statusH4 = document.getElementById("status");
			  statusH4.textContent = "Setting " + sNick + " as your referral code";
			  loadingScreen.style.display = "inline-flex";
	  
			  const formData = new FormData();
			  formData.append("setReferral", sNick);
	  
			  const url = "referral.php"; 
	  
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
				  if (data.includes("alreadyAdded")) {
					  var notyf = new Notyf();
					  notyf.error("This code is already added");
					  loadingScreen.style.display = "none";
				  }
	  
				  if (data.includes("alreadyHave")) {
					  var notyf = new Notyf();
					  notyf.error("You already have a referral code");
					  loadingScreen.style.display = "none";
				  }
	  
				  if (data.includes("maxLenght")) {
					  var notyf = new Notyf();
					  notyf.error("Nice try using developer tools, but the max lenght is 8");
					  loadingScreen.style.display = "none";
				  }
	  
				  if (data.includes("success")) {
					  window.location.reload();
				  }
				  
			  })
		  });
	  });
	  </script>
	  </div>

	  </div>
	  </div>
	  </div>
	  <div class="col-6 d-flex">
	<div class="card" >
	<div class="card-body"style="background-color:rgb(15, 13, 15);">
	<div class="d-sm-flex justify-content-between align-items-start">
		<div>
		 <b>Now you can gain rewards in Golden!</b>
		 <p class="card-subtitle card-subtitle-dash">	Is simply, for each purchase a user makes using your referral code, <br>you will receive a portion of what they pay, that means<br>

		 <ul>
			<li>You will recieve <b>$0.90</b> if your code is used in the purchase of Golden Monthly License</li>
			<li>You will recieve <b>$2.00</b> if your code is used in the purchase of Golden Lifetime License</li>
			<li>You will recieve <b>$5.00</b> if your code is used in the purchase of Golden Enterprise License</li>
		</ul>
		When you exceed <b>$25</b>, you will be able to request the withdrawal of your money in our Discord.
		 </p>
		</div>
	 
	  </div>
	  </div>

	  
	  
	  </div>
	  
	  </div>

	  </div>
	  
	
';
}
else{

	//your API processing
	echo '
	<div class="row">
	<div class="col-6 d-flex" style="width:785px;">
	<div class="card" >
	<div class="card-body"style="background-color:rgb(15, 13, 15);">
	<div class="d-sm-flex justify-content-between align-items-start">
		<div>
		  <h4 class="card-title card-title-dash">Your Referral Code is: '.$DATA->response.'</h4>
		  <p>Active since: '.$DATA2->response.'</p>';
		  
		  if (intval($DATA3->response) >= 25) {
			echo '<h4 class="card-title card-title-dash">Contact support in our Discord for redeem your balance</h4>';
		} 
		else
		{
			echo '<p>Balance redeemable at $25</p>';
		}

		  
		  echo '</div>
	 
		  </div>
		  </div>
		  </div>
		  </div>
		  <div class="col-6 d-flex">
	<div class="card" >
	<div class="card-body"style="background-color:rgb(15, 13, 15);">
	<div class="d-sm-flex justify-content-between align-items-start">

	<div class="card" style="scale:80%;background-color:rgb(15, 13, 15);">
	<div class="card-body">
		<div class="row">
			<div class="col mt-0">
				<h5 class="card-title">Balance</h5>
			</div>

			<div class="col-auto">
				<div class="stat text-primary">
					<i class="align-middle" data-feather="truck"></i>
				</div>
			</div>
		</div>
		<h2 class="mt-1 mb-3">$';

		if (strpos($DATA3->response, 'undefined') === false) {
			echo "$DATA3->response";
		} else {
			echo "0";
		}
		
		echo '</h2>
	</div>
</div>
<div class="card" style="scale:80%;background-color:rgb(15, 13, 15);">
	<div class="card-body" style="width: 300px; margin-left:15px;">
		<div class="row">
			<div class="col mt-0">
				<h5 class="card-title">Usages</h5>
			</div>

			<div class="col-auto">
				<div class="stat text-primary">
					<i class="align-middle" data-feather="users"></i>
				</div>
			</div>
		</div>
		<h2 class="mt-1 mb-3">';
		if (strpos($DATA4->response, 'undefined') === false) {
			$words = explode(',', $DATA4->response);
			$wordCount = count($words);
			echo "$wordCount";
		} else {
			echo "0";
		}
		
		echo '</h2>
	</div>
</div>


	</div>
	</div>
	</div>
	</div>
		  </div>
	
	

		<div class="col-12 d-flex">	
		<div class="card" >
		<div class="card-body"style="background-color:rgb(15, 13, 15); width:800px;">
		  ';

		  echo "

		  <div class=\"d-sm-flex justify-content-between align-items-start\">
		  <div>
			<h4 class=\"card-title card-title-dash\">Usages</h4>
		   <p class=\"card-subtitle card-subtitle-dash\">See your referral usages</p>
		  </div>
	   
		</div>
		
		<div class=\"table-responsive  mt-1\" style=\"max-height: 460px; overflow: auto;\">
	   ";
	   $tableHTML = '<table class="table select-table">
	   <thead>
		   <tr>
			   <th>Date</th>
			   <th>Country</th>
			   <th>Referral</th>
		   </tr>
	   </thead>
	   <tbody>';

	  
	   $tableHTML .= '</tr></tbody></table>';
echo $tableHTML;
echo "</div>
</div>
</div>
</div>
";


}

?>
							


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
