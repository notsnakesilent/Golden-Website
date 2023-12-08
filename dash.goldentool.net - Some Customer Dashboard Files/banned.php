<?php
include './credentials.php';



function decryptAES($encryptedData, $key) {
    $cipher = "aes-128-ecb";
    $options = OPENSSL_RAW_DATA;
    $decryptedData = openssl_decrypt(hex2bin($encryptedData), $cipher, $key, $options);
    return $decryptedData;
}	


if (isset($_GET['id'])) {
    $user = $_GET['id'];
	$respJson = file_get_contents("your api");
	$SEX = json_decode($respJson);
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

	<title>Golden - Banned</title>

	<link href="./app.css" rel="stylesheet">
	<link href="./style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
	<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
	
</head>

<body>
	<div id="loading-screen">
		<a class="sidebar-brand">
          <span class="align-middle"><img src="img/icons/icon-48x48.png"> | Dashboard</span>
        </a>
		<h4 id="status">Account banned | <?php echo $SEX->banned?></h4>
		<p class="mt-1">You can appeal your ban in our <a href="https://discord.gg/vPDMvYcRPc">Discord</a></p>
		<p>You need to have your username or Key at hand</p>
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
</div>
	<script src="js/app.js"></script>

	

</body>

</html>
