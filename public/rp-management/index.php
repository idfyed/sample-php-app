<?php
/**
 * Copyright 2017 (C) Diglias AB
 *
 * @author jonas
 *
 * Call the Diglias service trough a backend channel and add a attribute
 * to the Diglias users profile.
 *
 */

require '../../vendor/autoload.php';
require '../../config/config.php';

use Diglias\RPManagement\Client;


use sample\Template;


$client = new Client(COMPANY_NAME,COMPANY_NAME,RP_MANAGEMENT_SECRET,RP_MANAGEMENT_ENDPOINT);

$resultCode = $client->add($_POST['userid'], 'acme_loyaltyNumber', $_POST['value'] );

if (  $resultCode == 204 )
{
    $t = new Template('rp-management-success');
    echo $t->render( array(
        "value" => $_POST['value']
    ));

} else {
    $t = new Template('rp-management-error');
    echo $t->render( array(
        "statusCode" => $resultCode,
        "statusMessage" => "Unknow status message"
    ));
}