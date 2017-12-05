<?php
/**
 * Copyright 2017 (C) Diglias AB
 *
 *
 * Enumeration of possible end points - used as constrcutor argument
 * when creating a DigliasRelying party object.
 * @author jonas
 */

namespace Diglias\EAPI;

abstract class Endpoint
{
    const Prod = "https://login.diglias.com/main-eapi/begin";
    const ProdTest = "https://prodtest-login.diglias.com/main-eapi/begin";
    const Test = "https://test.diglias.com/main-eapi/begin";
}

?>