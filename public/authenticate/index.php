<?php
/**
 * Copyright 2019 (C) Idfyed Solutions AB
 *
 * @author jonas
 *
 * Prepare a message to the Idfyed server and redirect the users
 * browser to Idfyed to ask the user to authenticate.
 *
 */

require '../../vendor/autoload.php';
require '../../config/config.php';

use Idfyed\EAPI\RelyingParty;

use sample\Util;


// Generate a random request Id and store it in the session
$requestId = Util::generateRandomString();
session_start();
$_SESSION['IdfyedRequestId'] = $requestId;



$params = array(
    'auth_requestid' => $requestId,
    'auth_returnlink' => Util::buildEndpointURL("/authenticate/success.php"),
    'auth_cancellink' => Util::buildEndpointURL("/authenticate/cancel.php"),
    'auth_rejectlink' => Util::buildEndpointURL("/authenticate/reject.php")
);


// Find out of the requested attributes should be filtered or if the
// default configuration should be used.
if (count($_POST) > 0) {

    // To use a subset of the attributes, supply the names as a comma separated
    // list on the parameter auth_attributes.
    $params['auth_attributes'] = '';
    foreach ($_POST as $key => $value) {
        if (strlen($params['auth_attributes']) > 0) {
            $params['auth_attributes'] = $params['auth_attributes'] . ',';
        }
        $params['auth_attributes'] = $params['auth_attributes'] . $key;
   }
}

$RP = new RelyingParty(COMPANY_NAME, MAC_KEY, EAPI_ENDPOINT);

header('Location: ' . $RP->buildAuthnURL($params), true, 302);
