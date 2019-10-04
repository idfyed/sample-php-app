<?php
/**
 * Copyright 2019 (C) IDFyed Solutions AB
 *
 *
 * Enumeration of possible end points - used as constructor argument
 * when creating a Idfyed relying party object.
 * @author jonas
 */

namespace Idfyed\EAPI;

abstract class Endpoint
{
    const Prod = "https://login.idfyed.com/main-eapi/begin";
    const ProdTest = "https://prodtest-login.idfyed.com/main-eapi/begin";
    const Test = "https://test.idfyed.com/main-eapi/begin";
}

?>
