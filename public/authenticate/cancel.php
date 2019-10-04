<?php
/**
* Copyright 2019 (C) Idfyed Solutions AB
*
* @author jonas
*
* The Idfyed server will redirect the users browser this URL 
* if the user cancels the authentication.
*
*/

require '../../vendor/autoload.php';

use sample\Template;

$t = new Template('cancel');
echo $t->render(null);
