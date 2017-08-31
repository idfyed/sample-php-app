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

use Diglias\EAPI\RelyingParty;
use Diglias\EAPI\Endpoint;

use sample\Util;



// Generate a random request Id and store it in the session
$requestId = Util::generateRandomString();
session_start();
$_SESSION['DigliasRequestId'] = $requestId;



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

$RP = new RelyingParty(COMPANY_NAME, MAC_KEY, Endpoint::ProdTest);

header('Location: ' . $RP->buildAuthnURL($params), true, 302);




