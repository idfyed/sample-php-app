<?php
/**
* Copyright 2019 (C) IDFyed Solutions AB
*
* @author jonas
*
* The Diglias GO server will redirect the users browser this URL 
* if the user cancels the authentication.
*
*/

require '../../vendor/autoload.php';

use sample\Template;

$t = new Template('cancel');
echo $t->render(null);
