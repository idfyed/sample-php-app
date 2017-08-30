<?php
/**
* Copyright 2017 (C) Diglias AB
*
* @author jonas
*
* Prepare a message to the Diglias GO server and redirect the users
* browser to Diglias GO to ask the user to authenticate.
*
*/

require '../../vendor/autoload.php';
require '../../config/config.php';

use sample\DigliasRelyingParty;
use sample\DigliasEndpoint;

// Generate a random request Id and store it in a session cookie
$requestId = generateRandomString();
setcookie('DigliasRequestId', $requestId, null, null, null, false, true);

// Find out the base URL of the URL:s that the Diglias GO server
// will redirect the user to depending on result. The URL:s can not
// be relative since the call is originating from another server.
$url_base = ($_SERVER['HTTPS'] ? "https" : "http" ) .
            "://" .
            $_SERVER['SERVER_NAME'] .
            ":" .
            $_SERVER['SERVER_PORT'] .
            "/authenticate/";

$params  = array(
    'auth_requestid' => $requestId,
    'auth_returnlink' => $url_base . "success.php",
    'auth_cancellink' => $url_base . "cancel.php",
    'auth_rejectlink' => $url_base . "reject.php"
);

$RP = new DigliasRelyingParty(COMPANY_NAME, MAC_KEY, DigliasEndpoint::ProdTest );

header('Location: ' . $RP->build_authn_url( $params ) , true, 302 );


function generateRandomString($length = 16)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

