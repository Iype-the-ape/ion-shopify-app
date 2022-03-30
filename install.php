<?php

$_API_KEY = '62d8ceee53febd72a3261af9860debcc';
$_NGROK_url = 'https://b335-103-165-167-198.ngrok.io';
$shop = $_GET['shop'];
$scopes = 'read_products,write_products,read_orders,write_orders';
$redirect_uri = $_NGROK_url . '/ion/token.php';
$nonce = bin2hex( random_bytes( 12 ) );
$access_mode = 'per-user';

$oauth_url = 'https://' . $shop . '/admin/oauth/authorize?client_id=' . $_API_KEY . '&scope=' . $scopes . '&redirect_uri=' . urlencode($redirect_uri) . '&state=' . $nonce . '&grant_options[]=' . $access_mode;

//echo($oauth_url);
header("Location: " . $oauth_url);
exit();