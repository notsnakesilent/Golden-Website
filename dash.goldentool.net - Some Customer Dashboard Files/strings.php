<?php
include './credentials.php';
require './keyauth.php';

function errorHandler($errno, $errstr, $errfile, $errline)
{
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


function decryptAES($encryptedData, $key)
{
	$cipher = "aes-128-ecb";
	$options = OPENSSL_RAW_DATA;
	$decryptedData = openssl_decrypt(hex2bin($encryptedData), $cipher, $key, $options);
	return $decryptedData;
}

function encryptAES($data, $key)
{
	$cipher = "aes-128-ecb";
	$options = OPENSSL_RAW_DATA;
	$encryptedData = openssl_encrypt($data, $cipher, $key, $options);
	return bin2hex($encryptedData);
}

function obtenerCodigoPais($pais)
{
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

if (isset($_POST['addMulti'])) {
	$process = $_POST["addMulti"];
	$Multistring = $_POST["Multistring"];
	$status = $_POST["status"];
	$status = str_replace("\n", "", $status);
	$searchtype = $_POST["searchtype"];
	$searchtype = str_replace("\n", "", $searchtype);

	if (empty($process)) {
		echo "Format Error: Process/Service Name is empty";
		exit;
	}

	if (empty($Multistring)) {
		echo "Format Error: String is empty";
		exit;
	}

	if (strpos($status, "Select Status") !== false) {
		echo "Format Error: Status is not defined";
		exit;
	}

	if (strpos($searchtype, "Select Search Type") !== false) {
		echo "Format Error: Search Type is not defined";
		exit;
	}

// your code for save strings

		echo "success";
		exit;
	
}

if (isset($_POST['add'])) {
	$cstring = $_POST["add"];
	$partes = explode("?", $cstring);


	if (empty($partes[0])) {
		echo "Format Error: Detection Name is empty";
		exit;
	}

	if (empty($partes[2])) {
		echo "Format Error: Process/Service is empty";
		exit;
	}

	if (empty($partes[1])) {
		echo "Format Error: String is empty";
		exit;
	}

	if (strpos($partes[3], "Select Status") !== false) {
		echo "Format Error: Status is not defined";
		exit;
	}

	if (strpos($partes[4], "Select Search Type") !== false) {
		echo "Format Error: Search Type is not defined";
		exit;
	}

// your code for save strings

		echo "success";
		exit;
}


if (isset($_POST['delete'])) {
	$cstring = $_POST["delete"];

	$cstring = encryptAES($cstring, $key);
	// your code for delete strings

		echo "success";
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

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="./img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Golden - Scans</title>

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

			const content = document.getElementById('content');
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
								<i class="align-middle"></i> <span class="align-middle"><i class="lar la-user"></i>Profile</span>
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
						} else {
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
						} else {
							echo "
						<li class=\"sidebar-item active\">
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
						?>





						<?php

						if (strstr($subscription, "Default") !== false) {

							echo "</li>";
						} else {
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
							} else {
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

								<a>Logged in as<a class="nav-link d-sm-inline-block" href="#" data-bs-toggle="dropdown" style="color:white;"><?php echo $username; ?><i class="las la-angle-down ms-1"></i></a></a>

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

						<h1 class="h4 mb-3"><strong>Custom Strings</strong> | <?php

																				if (strstr($subscription, "-") !== false) {
																					$partes = explode("-", $subscription);

																					if (count($partes) > 1) {
																						$textoDespuesDelGuion = $partes[1];

																						echo $textoDespuesDelGuion . " - " . $partes[0];
																					}
																				} else {
																					echo $subscription;
																				}
																				?></h1>


						<div class="row">
							<div class="col-12 col-lg-8 col-xxl-9 d-flex" style="margin-bottom:10px;">
								<div class="card flex-fill">
									<div class="card-body" style="background-color:rgb(15, 13, 15);">


										<?php


										if (strstr($subscription, "Default") !== false) {

											echo "
								<div class=\"row\">
								<div class=\"col mt-0\">
									<h4 class=\"card-title\">You dont have an active license</h4>
								</div>

							</div>
							
						
							<a class=\"btn btn-primary\" style=\"margin-left:10px;width:300px;\" href=\"./purchase.php\" >Purchase</a>
							</div>
							</div>
							<ul class=\"navbar-nav navbar-align\">
				
</ul>
								
								
								";
										} else {


											if ("your API processing") {


												if ("your API processing") {
													echo '
	<div class="table-responsive  mt-1" style="max-height: 400px; overflow: auto;">
	<table class="table table-responsive">
										<thead>
											<tr>
												<th>Detection Name</th>
												<th>String</th>
												<th>Process/Service</th>
												<th>Status</th>
												<th>Search Type</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											
										</tbody>
									</table>
	';



													echo "</div>
		</div>
		</div>
		</div>";
												} else {

												

													if ("your API processing") {
														$tableHTML = '  <div class="table-responsive  mt-1" style="max-height: 400px; overflow: auto;">
	<table class="table table-responsive">
	<thead>
		<tr>
			<th>Detection Name</th>
			<th>String</th>
			<th>Process/Service</th>
			<th>Status</th>
			<th>Search Type</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>';
													//your code for processing custom strings
														}



													}
												}

												echo '


	  <div class="col-12 grid-margin stretch-card">
		<div class="card card-rounded">
		  <div class="card-body">
			<div class="d-sm-flex justify-content-between align-items-start">
			  <div>
				<h4 class="card-title card-title-dash">Add Strings</h4>
			   <p class="card-subtitle card-subtitle-dash">Set new custom strings</p>
			  </div>
			  </div>
			  <div class="col-12">
			  <div class="tab" >
				  <ul class="nav nav-tabs" role="tablist" >
					  <li class="nav-item" role="presentation"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab" role="tab" aria-selected="true" >Single Mode</a></li>
					<li class="nav-item" role="presentation"><a class="nav-link" href="#tab-2" data-bs-toggle="tab" role="tab" aria-selected="false" tabindex="-1">Multi Mode</a></li>
													 </ul>
				  <div class="tab-content">
					  <div class="tab-pane active show" id="tab-1" role="tabpanel" >
					  <div class="input-group mb-3">
					  <input type="text" class="form-control" id="detectionId" placeholder="Detection Name">
					  <input type="text" class="form-control" id="processId" placeholder="Process/Service">
					  <input type="text" class="form-control" id="stringId" placeholder="String">
					  <div class="select-container">
					  <select class="form-select"  id="statusId2" style="border-radius: 0px;height: 44px;">
					  <option>Select Status</option>
					  <option>Severe</option>
					  <option>Warning</option>
					  <option>Information</option>
						  </select>
						  </div>
						  <div class="select-container">
						  <select class="form-select"  id="searchType" style="border-radius: 0px;height: 44px;">
						  <option>Select Search Type</option>
						  <option>Contains</option>
						  <option>Equals</option>
							  </select>
					   </div>
					  <button class="create-btn" style="margin-top:0;margin-left:25px;" type="button">Add</button>
				  </div>

				  <script>
				  const ettons = document.querySelectorAll(".create-btn");
				  ettons.forEach(button => {
					  button.addEventListener("click", function() {
						  const detection= document.getElementById("detectionId");
						  const detectionname = detection.value;
						  const process= document.getElementById("processId");
						  const processname = process.value;
						  const string= document.getElementById("stringId");
						  const stringname = string.value;
						  const status = document.getElementById("statusId2");
						  const statusname = status.value;

						  const searchT = document.getElementById("searchType");
						  const searchtype = searchT.value;

						  const loadingScreen = document.getElementById("loading-screen");
						  const statusH4 = document.getElementById("status");
						  statusH4.textContent = "Adding your Custom String";
						  loadingScreen.style.display = "inline-flex";
						  
						  var dt = detectionname + "?" + processname + "?" + stringname +"?" + statusname+"?" + searchtype;
						  console.log(dt);
						  const formData = new FormData();
						  formData.append("add", dt);
				  
						  const url = "strings.php"; 
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
							console.log(data);
								  if (data.includes("Format")) {
								  var notyf = new Notyf();
								  notyf.error(data);
								  loadingScreen.style.display = "none";
								  return;
								  }

							  if (data.includes("success")) {
								var notyf = new Notyf();
								notyf.success("Successfully added your Custom String");
								loadingScreen.style.display = "none";
								window.location.reload();
							}
				
						  })
					  });
				  });
				  </script>



					  </div>

					  

					  <div class="tab-pane" id="tab-2" role="tabpanel">
					  <div class="col-sm-12">

					  <div style="display: -webkit-inline-box;" class="mb-3">


					  <input type="text" class="form-control" id="processNa" placeholder="Process/Service">
		
					  <div class="select-container">
					  <select class="form-select"  id="statusId2" style="border-radius: 0px;height: 44px;">
					  <option>Select Status</option>
					  <option>Severe</option>
					  <option>Warning</option>
					  <option>Information</option>
						  </select>
						  </div>
						  <div class="select-container">
						  <select class="form-select"  id="searchType" style="border-radius: 0px;height: 44px;">
						  <option>Select Search Type</option>
						  <option>Contains</option>
						  <option>Equals</option>
							  </select>
					   </div>
					   <button class="file-btn" style="margin-top:0;margin-left:25px;" type="button">Add</button>


				
				  		</div>
						  <textarea class="form-control" id="multiString" placeholder="Detection Name:::String" rows="6"  style="height:180px"></textarea>
					  </div>
			

					


					  </div>
					  </div>
					  </div>
					  </div>
					  
					  <script>
					  const ttons = document.querySelectorAll(".file-btn");
					  ttons.forEach(button => {
						  button.addEventListener("click", function() {
							  const process= document.getElementById("processNa");
							  const processname = process.value;
							  const string = document.getElementById("multiString");
							  const stringname = string.value;
							  const status = document.getElementById("statusId2");
							  const statusname = status.value;

							  const searchT = document.getElementById("searchType");
							  const searchtype = searchT.value;

							  const loadingScreen = document.getElementById("loading-screen");
							  const statusH4 = document.getElementById("status");
							  statusH4.textContent = "Adding your Custom Strings";
							  loadingScreen.style.display = "inline-flex";

							  const formData = new FormData();
							  formData.append("addMulti", processname);
							  formData.append("Multistring", stringname);
							  formData.append("status", statusname);
							  formData.append("searchtype", searchtype);
							  
							  const url = "strings.php"; 
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
								console.log(data);
									  if (data.includes("Format")) {
									  var notyf = new Notyf();
									  notyf.error(data);
									  loadingScreen.style.display = "none";
									  return;
									  }
	
								  if (data.includes("success")) {
									var notyf = new Notyf();
									notyf.success("Successfully added your Custom Strings");
									loadingScreen.style.display = "none";
									window.location.reload();
								}
					
							  })
						  });
					  });
					  </script>
	
					 
					  ';















												echo "";
											}

											echo '


											<div class="col-12 grid-margin stretch-card">
											  <div class="card card-rounded">
												<div class="card-body">
												  <div class="d-sm-flex justify-content-between align-items-start">
													<div>
													  <h4 class="card-title card-title-dash">Add Strings</h4>
													 <p class="card-subtitle card-subtitle-dash">Set new custom strings</p>
													</div>
													</div>
													<div class="col-12">
													<div class="tab" >
														<ul class="nav nav-tabs" role="tablist" >
															<li class="nav-item" role="presentation"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab" role="tab" aria-selected="true" >Single Mode</a></li>
														  <li class="nav-item" role="presentation"><a class="nav-link" href="#tab-2" data-bs-toggle="tab" role="tab" aria-selected="false" tabindex="-1">Multi Mode</a></li>
																						   </ul>
														<div class="tab-content">
															<div class="tab-pane active show" id="tab-1" role="tabpanel" >
															<div class="input-group mb-3">
															<input type="text" class="form-control" id="detectionId" placeholder="Detection Name">
															<input type="text" class="form-control" id="processId" placeholder="Process/Service">
															<input type="text" class="form-control" id="stringId" placeholder="String">
															<div class="select-container">
															<select class="form-select"  id="statusId2" style="border-radius: 0px;height: 44px;">
															<option>Select Status</option>
															<option>Severe</option>
															<option>Warning</option>
															<option>Information</option>
																</select>
																</div>
																<div class="select-container">
																<select class="form-select"  id="searchType" style="border-radius: 0px;height: 44px;">
																<option>Select Search Type</option>
																<option>Contains</option>
																<option>Equals</option>
																	</select>
															 </div>
															<button class="create-btn" style="margin-top:0;margin-left:25px;" type="button">Add</button>
														</div>
									  
														<script>
														const ettons = document.querySelectorAll(".create-btn");
														ettons.forEach(button => {
															button.addEventListener("click", function() {
																const detection= document.getElementById("detectionId");
																const detectionname = detection.value;
																const process= document.getElementById("processId");
																const processname = process.value;
																const string= document.getElementById("stringId");
																const stringname = string.value;
																const status = document.getElementById("statusId2");
																const statusname = status.value;

																const searchT = document.getElementById("searchType");
																const searchtype = searchT.value;

																const loadingScreen = document.getElementById("loading-screen");
																const statusH4 = document.getElementById("status");
																statusH4.textContent = "Adding your Custom String";
																loadingScreen.style.display = "inline-flex";
																
																var dt = detectionname + "?" + processname + "?" + stringname +"?" + statusname + "?" + searchtype;
																console.log(dt);
																const formData = new FormData();
																formData.append("add", dt);
														
																const url = "strings.php"; 
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
																  console.log(data);
																		if (data.includes("Format")) {
																		var notyf = new Notyf();
																		notyf.error(data);
																		loadingScreen.style.display = "none";
																		return;
																		}
									  
																	if (data.includes("success")) {
																	  var notyf = new Notyf();
																	  notyf.success("Successfully added your Custom String");
																	  loadingScreen.style.display = "none";
																	  window.location.reload();
																  }
													  
																})
															});
														});
														</script>
									  
									  
									  
															</div>
									  
															
									  
															<div class="tab-pane" id="tab-2" role="tabpanel">
															<div class="col-sm-12">
									  
															<div style="display: -webkit-inline-box;" class="mb-3">
									  
									  
															<input type="text" class="form-control" id="processNa" placeholder="Process/Service">
											  
															<div class="select-container ms-2">
															<select class="form-select"  id="statusId2" style="border-radius: 0px;height: 44px;">
															<option>Select Status</option>
															<option>Severe</option>
															<option>Warning</option>
															<option>Information</option>
																</select>
																</div>
																<div class="select-container ms-2">
																<select class="form-select"  id="searchType" style="border-radius: 0px;height: 44px;">
																<option>Select Search Type</option>
																<option>Contains</option>
																<option>Equals</option>
																	</select>
															 </div>


															 <button class="file-btn" style="margin-top:0;margin-left:25px;" type="button">Add</button>
									  
									  
													  
																</div>
																<textarea class="form-control" id="multiString" placeholder="Detection Name:::String" rows="6"  style="height:180px"></textarea>
															</div>
												  
									  
														  
									  
									  
															</div>
															</div>
															</div>
															</div>
															
															<script>
															const ttons = document.querySelectorAll(".file-btn");
															ttons.forEach(button => {
																button.addEventListener("click", function() {
																	const process= document.getElementById("processNa");
																	const processname = process.value;
																	const string = document.getElementById("multiString");
																	const stringname = string.value;
																	const status = document.getElementById("statusId2");
																	const statusname = status.value;
																	const searchT = document.getElementById("searchType");
																	const searchtype = searchT.value;

																	const loadingScreen = document.getElementById("loading-screen");
																	const statusH4 = document.getElementById("status");
																	statusH4.textContent = "Adding your Custom Strings";
																	loadingScreen.style.display = "inline-flex";
									  
																	const formData = new FormData();
																	formData.append("addMulti", processname);
																	formData.append("Multistring", stringname);
																	formData.append("status", statusname);
									  								formData.append("searchtype", searchtype);

																	const url = "strings.php"; 
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
																	  console.log(data);
																			if (data.includes("Format")) {
																			var notyf = new Notyf();
																			notyf.error(data);
																			loadingScreen.style.display = "none";
																			return;
																			}
										  
																		if (data.includes("success")) {
																		  var notyf = new Notyf();
																		  notyf.success("Successfully added your Custom Strings");
																		  loadingScreen.style.display = "none";
																		  window.location.reload();
																	  }
														  
																	})
																});
															});
															</script>
										  
														   
															';
									  
									  




	


										?>

										<script>
											const enviarButtons = document.querySelectorAll(".rm-btn");
											enviarButtons.forEach(button => {
												button.addEventListener("click", function() {
													const fila = button.closest("tr");
													const columnas = fila.querySelectorAll("td");
													const string = columnas[0].textContent + "?" + columnas[2].textContent + "?" + columnas[1].textContent + "?" + columnas[3].textContent+ "?" + columnas[4].textContent;
													const loadingScreen = document.getElementById('loading-screen');
													const statusH4 = document.getElementById('status');
													statusH4.textContent = "Removing the Custom String";
													loadingScreen.style.display = 'inline-flex';

													const formData = new FormData();
													formData.append("delete", string);

													const url = "strings.php";
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
																notyf.success("Successfully deleted your Custom String");
																loadingScreen.style.display = "none";
																window.location.reload();
															}

														})
												});
											});
										</script>






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
	</div>
	<script src="js/app.js"></script>



</body>

</html>