<?php

/**
 * Copyright 2019 (C) Idfyed Solutions AB
 *
 * @author jonas
 *
 * The Idfyed GO server will redirect the users browser to POST to this URL
 * once the authentication has been sucessfully completed.
 *
 */


require '../../vendor/autoload.php';
require '../../config/config.php';

use Idfyed\EAPI\RelyingParty;
use sample\Template;

// Only render as a success if the response can be verified
$RP = new RelyingParty(COMPANY_NAME, MAC_KEY, EAPI_ENDPOINT);

if ($RP->verifyAuthnResponse($_POST)) {

    // Check that the response was intended for this request
    session_start();
    if ($_POST["auth_inresponseto"] === $_SESSION["IdfyedRequestId"]) {

        $t = new Template('success');
        echo $t->render( array(
           'body' => $_POST
        ));

    } else {
        $t = new Template('invalid-request');
        echo $t->render( null);
    }
} else {
    $t = new Template('invalid-mac');
    echo $t->render( null);
}
