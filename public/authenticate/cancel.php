<?php
/**
* Copyright 2017 (C) Diglias AB
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
  