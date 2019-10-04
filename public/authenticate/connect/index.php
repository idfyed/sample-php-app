<?php
/**
 * Copyright 2019 (C) Idfyed Solutions AB
 *
 * Prepare a message to the Idfyed server and redirect the users
 * browser to Idfyed to ask the user to have a attribute added to
 * their Idfyed.
 *
 * @author jonas
 *
 */

require '../../../vendor/autoload.php';
require '../../../config/config.php';

use Idfyed\EAPI\RelyingParty;

use sample\Util;

// Generate a random request Id and store it in the session
$requestId = Util::generateRandomString();
session_start();
$_SESSION['IdfyedRequestId'] = $requestId;

// A timestamp is required for a connect transaction
$now = new DateTime("now", new DateTimeZone('UTC'));

$params = array(
    'auth_requestid' => $requestId,
    'auth_returnlink' => Util::buildEndpointURL("/authenticate/success.php"),
    'auth_cancellink' => Util::buildEndpointURL("/authenticate/cancel.php"),
    'auth_rejectlink' => Util::buildEndpointURL("/authenticate/reject.php"),
    'auth_timestamp' => $now->format(DATE_ATOM),

    // Add the value from the form as a auth_rp_* attribute
    // For this to work, the RP will have to be configured as a ambassador for the attribute.
    "auth_rp_acme_loyaltyNumber" => $_POST["value"],

    // Only show the connect attribute to the user, if this is omitted the user will be requested to give
    // all attributes specified in the RP - this might seem illogical depending on use case.
    "auth_attributes" => "acme_loyaltyNumber"
);

// Build the URL and redirect the users browser to it.
$RP = new RelyingParty(COMPANY_NAME, MAC_KEY, EAPI_ENDPOINT);
header('Location: ' . $RP->buildAuthnURL($params), true, 302);
