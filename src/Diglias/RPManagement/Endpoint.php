<?php

/**
 * Copyright 2019 (C) IDFyed Solutions AB
 *
 * @author jonas
 *
 * Enumeration of possible end points - used as constrcutor argument
 * when creating a Client party object.
 *
 */

namespace Diglias\RPManagement;

abstract class Endpoint
{
    const Prod = "https://api.idfyed.com/rp-mgmt/attribute/v1.0/";
    const ProdTest = "https://prodtest-login.idfyed.com/rp-mgmt/attribute/v1.0/";
    const Test = "https://test.idfyed.com/rp-mgmt/attribute/v1.0/";
    const Build = "https://build.idfyed.com/rp-mgmt/attribute/v1.0/";
}

?>
