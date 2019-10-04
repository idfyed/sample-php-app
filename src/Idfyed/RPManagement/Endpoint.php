<?php

/**
 * Copyright 2019 (C) Idfyed Solutions AB
 *
 * @author jonas
 *
 * Enumeration of possible end points - used as constructor argument
 * when creating a Client object.
 *
 */

namespace Idfyed\RPManagement;

abstract class Endpoint
{
    const Prod = "https://api.idfyed.com/rp-mgmt/attribute/v1.0/";
    const ProdTest = "https://prodtest-login.idfyed.com/rp-mgmt/attribute/v1.0/";
    const Test = "https://test.idfyed.com/rp-mgmt/attribute/v1.0/";
    const Build = "https://build.idfyed.com/rp-mgmt/attribute/v1.0/";
}

?>
