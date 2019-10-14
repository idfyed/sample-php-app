<?php
/**
 * Copyright 2019 (C) Idfyed Solutions AB
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
