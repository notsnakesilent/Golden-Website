<?php
require 'credentials.php';
require 'keyauth.php';

function errorHandler($errno, $errstr, $errfile, $errline) {
		echo "<meta http-equiv='Refresh' Content='2; url=501.html'>";
    exit();
}

set_error_handler('errorHandler');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['un']))
{
    header("Location: ./dashboard");
    exit();
}

$KeyAuthApp = new KeyAuth\api($name, $ownerid);

if (!isset($_SESSION['sessionid'])) 
{
	$KeyAuthApp->init();
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
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Register | Golden Dashboard</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
	<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

	<link href="app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

	<script>
    
 window.addEventListener('load', () => {
    const loadingScreen = document.getElementById('loading-screen');
    loadingScreen.style.display = 'none';

    const content = document.getElementById('d-flex');
    content.style.display = 'block';
});
	</script>
</head>

<body>
<div id="loading-screen">
        <div class="spinner"></div>
    </div>

	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2"><img src="img/icons/icon-48x48.png" /> | Welcome back!</h1>
							<p class="lead">
								Register a new account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<form class="login100-form validate-form flex-sb flex-w" method="post">
										<div class="mb-3">
											<label class="form-label">Username</label>
											<input class="form-control form-control-lg" type="text" name="username" placeholder="Enter your username" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
										</div>

										<div class="mb-3">
											<label class="form-label">Key</label>
											<input class="form-control form-control-lg" type="text" name="key" placeholder="Enter your key (If you have one)" />
										</div>

										<div class="d-grid gap-2 mt-3">
											<button name="register" class="btn btn-lg btn-primary">Register</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="text-center mb-3">
							Have an account? <a href="https://dash.goldentool.net">Log In</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>
	
	<?php
	      $regKey = genKey();
		if (isset($_POST['register'])) {



			if (empty($_POST['key'])) {
				if ($KeyAuthApp->register($_POST['username'], $_POST['password'],$regKey)) {
					$_SESSION['un'] = $_POST['username'];
					echo "<meta http-equiv='Refresh' Content='2; url=./dashboard'>";
					echo '
								<script type=\'text/javascript\'>
								
								const notyf = new Notyf();
								notyf
								  .success({
									message: \'You have successfully registered!\',
									duration: 3500,
									dismissible: true
								  });                
								
								</script>
								';
				}
			} else {
				if ($KeyAuthApp->register($_POST['username'], $_POST['password'],$_POST['key'])) {
					$_SESSION['un'] = $_POST['username'];
					echo "<meta http-equiv='Refresh' Content='2; url=./dashboard'>";
					echo '
								<script type=\'text/javascript\'>
								
								const notyf = new Notyf();
								notyf
								  .success({
									message: \'You have successfully registered!\',
									duration: 3500,
									dismissible: true
								  });                
								
								</script>
								';
				}
			}
		
	}

	function genKey() {
		$SellerKey = "your seller key";
		$Expiry = "999999"; // In Days
		$KeyMask = "XXXXXX-XXXXXX-XXXXXX-XXXXXX-XXXXXX-XXXXXX"; // Key Mask for key that will be generated
		$KeyLevel = "1"; // License key Level from subscription levels page

		$ch = curl_init("your API");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$regKey = curl_exec($ch);
		curl_close($ch);
		return $regKey;
	}
	?>

</body>

</html>