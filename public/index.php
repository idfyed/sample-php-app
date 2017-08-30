<?php
/**
 * Copyright 2017 (C) Diglias AB
 *
 * @author jonas
 *
 * Render the application start page.
 *
 */

require '../vendor/autoload.php';

use sample\Template;

$index = new Template('index');

echo $index->render(null);
