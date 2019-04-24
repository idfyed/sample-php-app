<?php

// The COMPANY_NAME is supplied by IDFyed when a configuration for a
// specific customer is set up in the Diglias Go system.
define("COMPANY_NAME","playground",true);

// The MAC_KEY is supplied by IDFyed when a configuration for a
// specific customer is set up in the Diglias Go system. It should be
// used to verify the authenticity of all messages passed to and received
// from the Diglias Go server.
define("MAC_KEY","LW4eUhQkJfwJGgQU8JCT/g==",true);

// Diglias backend environment to use for authentication.
define("EAPI_ENDPOINT", Diglias\EAPI\Endpoint::Prod, true);

// Key/Password used when accessing the RP Management API.
define("RP_MANAGEMENT_SECRET", "LW4eUhQkJfwJGgQU8JCT/g==", true);

// Diglias backend environment when accessing the RP Management API.
define("RP_MANAGEMENT_ENDPOINT", Diglias\RPManagement\Endpoint::Prod, true);
