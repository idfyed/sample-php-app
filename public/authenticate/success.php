<?php

/**
 * Copyright 2019 (C) IDFyed Solutions AB
 *
 * @author jonas
 *
 * The IDFyed GO server will redirect the users browser to POST to this URL
 * once the authenitcation has been sucessfullty completed.
 *
 */


require '../../vendor/autoload.php';
require '../../config/config.php';

use IdFyed\EAPI\RelyingParty;
use sample\Template;

// Only render as a success if the response can be verified
$RP = new RelyingParty(COMPANY_NAME, MAC_KEY, EAPI_ENDPOINT);

if ($RP->verifyAuthnResponse($_POST)) {

    // Check that the response was intended for this request
    session_start();
    if ($_POST["auth_inresponseto"] === $_SESSION["IdFyedRequestId"]) {

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
