<?php
include './credentials.php';
require './keyauth.php';

function errorHandler($errno, $errstr, $errfile, $errline) {
		echo "<meta http-equiv='Refresh' Content='2; url=501.html'>";
    exit();
}

set_error_handler('errorHandler');


if ( session_status() === PHP_SESSION_NONE ) {
    session_start();
}

if ( !isset( $_SESSION[ 'un' ] ) ) {
    header( 'Location: ./signin.php' );
    exit();
}

if ( isset( $_POST[ 'logout' ] ) ) {
    session_destroy();
    header( 'Location: ./signin.php' );
    exit();
}

function decryptAES( $encryptedData, $key ) {
    $cipher = 'aes-128-ecb';
    $options = OPENSSL_RAW_DATA;
    $decryptedData = openssl_decrypt( hex2bin( $encryptedData ), $cipher, $key, $options );
    return $decryptedData;
}


$KeyAuthApp = new KeyAuth\api( $name, $ownerid );

$url = "your API";

$curl = curl_init( $url );
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );

$resp = curl_exec( $curl );
$json = json_decode( $resp );

if ( !$json->success ) {
    die( "Error: {$json->message}" );
}

$download = $json->download;
$webdownload = $json->webdownload;
$appcooldown = $json->cooldown;

function findSubscription( $name, $list )
 {
    for ( $i = 0; $i < count( $list );
    $i++ ) {
        if ( $list[ $i ]->subscription == $name ) {
            return true;
        }
    }
    return false;
}

$username = $_SESSION[ 'user_data' ][ 'username' ];
$respJson = file_get_contents("your API");
$DATA = json_decode( $respJson );

if ( empty( $DATA->subscriptions[ 0 ]->subscription ) ) {
    $subscription = 'User';
} else {
    $subscription = $DATA->subscriptions[ 0 ]->subscription;
}

if ( strpos( $subscription, 'default' ) !== false ) {
    $subscription = 'Default';
}

$subscriptions = $_SESSION[ 'user_data' ][ 'subscriptions' ];
$expiry = $_SESSION[ 'user_data' ][ 'subscriptions' ][ 0 ]->expiry;

if ( isset( $_GET[ 'code' ] ) ) {
    $Username = $_GET[ 'code' ];

$Username = decryptAES($Username,$key);
$respJson = file_get_contents("your API");
 }
  ?>

                            <!DOCTYPE html>
                            <html lang = 'en'>

                            <head>
                            <meta charset = 'utf-8'>
                            <meta http-equiv = 'X-UA-Compatible' content = 'IE=edge'>
                            <meta name = 'viewport' content = 'width=device-width, initial-scale=1, shrink-to-fit=no'>
                            <meta name = 'description' content = 'Responsive Admin &amp; Dashboard Template based on Bootstrap 5'>
                            <meta name = 'author' content = 'AdminKit'>
                            <meta name = 'keywords' content = 'adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web'>
                            <script src = 'https://cdn.keyauth.uk/dashboard/unixtolocal.js'></script>

                            <link rel = 'preconnect' href = 'https://fonts.gstatic.com'>
                            <link rel = 'shortcut icon' href = './img/icons/icon-48x48.png' />

                            <link rel = 'canonical' href = 'https://demo-basic.adminkit.io/' />

                            <title>Golden - Purchase</title>

                            <link href = './app.css' rel = 'stylesheet'>
                            <link href = './style.css' rel = 'stylesheet'>
                            <link rel = 'stylesheet' href = 'https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css'>
                            <link href = 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap' rel = 'stylesheet'>

                            <link rel = 'stylesheet' href = 'https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css'>
                            <script src = 'https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js'></script>

                            </head>

                            <body>
                            <div id = 'loading-screen'>
                            <a class = 'sidebar-brand'>
                            <span class = 'align-middle'><img src = 'img/icons/icon-48x48.png'> | Dashboard</span>
                            </a>
                            <h4 id = 'status'>Email verified</h4>
                            <p class = 'mt-1'>If you need support contact us via<a href = 'https://discord.gg/vPDMvYcRPc'> Discord</a></p>

                            </div>

                            </div>
                            </div>
                            </div>
                            <div>

                            </div>
                            </main>

                            <footer class = 'footer'>
                            <div class = 'container-fluid'>
                            <div class = 'row text-muted'>
                            <div class = 'col-6 text-start'>
                            <p class = 'mb-0'>
                            <a class = 'text-muted'>© 2023 </a><a class = 'text-muted' href = 'https://goldentool.net' target = '_blank'><strong>Golden Solutions LLC</strong></a><a class = 'text-muted'>. All rights reserved</a>
                            </p>
                            </div>
                            </div>
                            </div>
                            </footer>
                            </div>
                            </div>
                            </div>
                            <script src = 'js/app.js'></script>

                            </body>

                            </html>
