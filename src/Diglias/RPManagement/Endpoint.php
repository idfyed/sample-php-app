<?php

/**
 * Copyright 2017 (C) Diglias AB
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
    const Prod = "https://api.diglias.com/rp-mgmt/attribute/v1.0/";
    const ProdTest = "https://prodtest-login.diglias.com/rp-mgmt/attribute/v1.0/";
    const Test = "https://test.diglias.com/rp-mgmt/attribute/v1.0/";
    const Build = "https://build.diglias.com/rp-mgmt/attribute/v1.0/";
}

?>
