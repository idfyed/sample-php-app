<?php
/**
 * Copyright 2019 (C) Idfyed Solutions AB
 *
 * @author jonas
 *
 * Receives the authnResponse from the Idfyed service and transforms it to
 * a request that normally would be sent to the application in the app-initiated flow.
 *
 */

require '../../vendor/autoload.php';
require '../../config/config.php';

use Idfyed\EAPI\RelyingParty;

// Add a timestamp to the response, it would normally be in the response from the Idfyed service
// as part of a app-initiated flow.
$now = new DateTime("now", new DateTimeZone('UTC'));
$_POST['auth_timestamp'] = $now->format(DATE_ISO8601);

// Since we add a auth_* parameter we need to compute a new MAC.
$_POST['mac'] = RelyingParty::computeMac($_POST, MAC_KEY);

// Rename the "RelayState" parameter to "payload"
$_POST["payload"] = $_POST["RelayState"];
unset($_POST["RelayState"]);

// Redirect to the entrypoint - this GET request would normally originate from
// a web view in the Idfyed app to the webb application.
header('Location: ' . '/app-initiated/?' . http_build_query($_POST), true, 302);
