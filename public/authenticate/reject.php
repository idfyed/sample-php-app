<?php
/**
 * Copyright 2019 (C) IDFyed Solutions AB
 *
 * @author jonas
 *
 * The Idfyed GO server will redirect the users browser this URL
 * if the authentication gets rejected by the Idfyed GO server.
 *
 */

require '../../vendor/autoload.php';

use sample\Template;

$t = new Template('reject');
echo $t->render( array(
        'code' => $_GET['error_code'],
        'message' => $_GET['error_message']
));
