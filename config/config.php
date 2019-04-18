<?php

// The COMPANY_NAME is supplied by IDFyed when a configuration for a
// specific customer is set up in the IDFyed Go system.
define("COMPANY_NAME","playground",true);

// The MAC_KEY is supplied by IDFyed when a configuration for a
// specific customer is set up in the IDFyed Go system. It shoule be
// used to verify the authenticity of all messages passed to and recived
// from the IDFyed Go server.
define("MAC_KEY","LW4eUhQkJfwJGgQU8JCT/g==",true);

// IDFyed backend environment to use for authentication.
define("EAPI_ENDPOINT", IdFyed\EAPI\Endpoint::Prod, true);

// Key/Password used when accessing the RP Management API.
define("RP_MANAGEMENT_SECRET", "LW4eUhQkJfwJGgQU8JCT/g==", true);

// IDFyed backend environment when accessing the RP Management API.
define("RP_MANAGEMENT_ENDPOINT", IdFyed\RPManagement\Endpoint::Prod, true);
