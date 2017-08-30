<?php
/**
 * Copyright 2017 (C) Diglias AB
 *
 * @author jonas
 *
 * The Diglias GO server will redirect the users browser this URL
 * if the authentication gets rejected by the Diglias GO server.
 *
 */

require '../../vendor/autoload.php';

use sample\Template;

$t = new Template('reject');
echo $t->render( array(
        'code' => $_GET['error_code'],
        'message' => $_GET['error_message']
));

