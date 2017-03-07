<?php
/*
* Copyright 2016 (C) Diglias AB
*
* @author jonas
*
* The Diglias GO server will redirect the users browser to POST to this URL 
* once the authenitcation has been sucessfullty completed.
*
*/
require '../inc/header.php';
require '../inc/diglias.php';
require '../inc/config.php';

// Only render as a success if the response can be verified
$RP = new DigliasRelyingParty(COMPANY_NAME, MAC_KEY, DigliasEndpoint::ProdTest);

if ($RP->verify_authn_response($_POST)) {

    // Check that the reposnse was intended for this request
    if ($_POST["auth_inresponseto"] === $_COOKIE["DigliasRequestId"]) {
        ?>
        <h1>Success</h1>
        <p>Authenticaton sucessful</p>
        <table>
            <tr>
                <th>Parameter</th>
                <th>Value</th>
            </tr>
            <?php foreach ($_POST as $key => $value) { ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $value ?></td>
                </tr>
            <?php } ?>
        </table>
        <p></p>
        <a href="/authenticate">Authenticate again</a>
        <?php
    } else {
        ?>
        <h1>Login failed</h1>
        <p>The reposnse whas not intended for this session.</p>
        <p><a href="/authenticate">Try again</a></p>
        <?php
    }
} else {
    ?>
    <h1>Login failed</h1>
    <p>MAC could not be validated.</p>
    <p><a href="/authenticate">Try again</a></p>
    <?php
}

require '../inc/footer.php';
?>
  