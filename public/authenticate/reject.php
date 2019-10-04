<?php
/**
 * Copyright 2019 (C) Idfyed Solutions AB
 *
 * @author jonas
 *
 * The Idfyed server will redirect the users browser this URL
 * if the authentication gets rejected by the Idfyed server.
 *
 */

require '../../vendor/autoload.php';

use sample\Template;

$t = new Template('reject');
echo $t->render( array(
        'code' => $_GET['error_code'],
        'message' => $_GET['error_message']
));
