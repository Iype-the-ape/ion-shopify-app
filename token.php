<?php
include_once("includes/mysql_connect.php");

$api_key = '62d8ceee53febd72a3261af9860debcc';
$secret_key = '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';
$parameters = $_GET;
$shop_url = $parameters['shop'];
$hmac = $parameters['hmac'];
$parameters = array_diff_key($parameters, array('hmac' => ''));
ksort($parameters);

$new_hmac = hash_hmac('sha256', http_build_query($parameters), $secret_key);

if ( hash_equals($hmac, $new_hmac)){
    $access_token_endpoint = 'https://' . $shop_url . '/admin/oauth/access_token';
    $var = array(
        "client_id" => $api_key,
        "client_secret" => $secret_key,
        "code" => $parameters['code']
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $access_token_endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, count($var));
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($var));
    $response = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($response, true);
    
    echo print_r($response);

    //$query2 = "CREATE TABLE `ion_db`.`shops` ( `id` INT NOT NULL AUTO_INCREMENT , `shop_url` VARCHAR(255) NOT NULL , `access_token` VARCHAR(255) NOT NULL , `hmac` VARCHAR(255) NOT NULL , `install_date` DATETIME NOT NULL , PRIMARY KEY (`id`), UNIQUE `shop_url` (`shop_url`));"; 
    $query = "INSERT INTO shops (shop_url, access_token, install_date) VALUES ('" . $shop_url . "','" . $response['access_token'] . "', NOW()) ON DUPLICATE KEY UPDATE access_token='" . $response['access_token'] . "'";
    if($mysql->query($query)) {
        echo "<script>top.window.location = 'https://" . $shop_url . "/admin/apps'</script>";
        die; 
    }
} else {
    echo ("This is not coming from shopify, possibly malicious");
}


echo print_r($parameters);