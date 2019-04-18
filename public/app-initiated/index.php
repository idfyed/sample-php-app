<?php
/**
 * Copyright 2019 (C) IDFyed Solutions AB
 *
 * @author jonas
 *
 * The main entrypoint to the application in the app initiated flow. This URL will be receive
 * a GET request once the user has scanned a static QR code. The reponse will be rendered in a webview
 * in the IDFyed app and the user perception is that the user is still in the context of the App.
 *
 */

require '../../vendor/autoload.php';
require '../../config/config.php';

use IdFyed\EAPI\RelyingParty;

use sample\Template;
use sample\Util;


// Validate that the response has not been tampered with
$RP = new RelyingParty( COMPANY_NAME, MAC_KEY, EAPI_ENDPOINT);
if (!$RP->verifyAuthnResponse($_GET)){
    $t = new Template('invalid-mac');
    echo $t->render(null);
    exit;
}

// Check that the timestamp is reasonably fresh - of not a replay attack might be suspected,
// allow it to be max 1000 msec old.
$now = new DateTime("now", new DateTimeZone('UTC'));
$requestTimeStamp = DateTime::createFromFormat(DATE_ISO8601, $_GET["auth_timestamp"], new DateTimeZone('UTC'));
if ( $now->getTimestamp() - $requestTimeStamp->getTimestamp() > 1000 ) {
    $t = new Template('to-old-timestamp');
    echo $t->render(null);
    exit;
}

// Check that the request id has not been used before, if it has it might be a replay attack.
if ( !Util::validateRequestId($_GET["auth_inresponseto"]) ) {
    $t = new Template('request-already-used');
    echo $t->render(null);
    exit;
}

// Render a result in the app
$t = new Template('app-initiated-success');
echo $t->render(array( 'body' => $_GET ) );
