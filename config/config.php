<?php

// The COMPANY_NAME is supplied by Idfyed when a configuration for a
// specific customer is set up in the Idfyed system.
define("COMPANY_NAME","playground",true);

// The MAC_KEY is supplied by Idfyed when a configuration for a
// specific customer is set up in the Idfyed system. It should be
// used to verify the authenticity of all messages passed to and received
// from the Idfyed server.
define("MAC_KEY","LW4eUhQkJfwJGgQU8JCT/g==",true);

// Idfyed backend environment to use for authentication.
define("EAPI_ENDPOINT", Idfyed\EAPI\Endpoint::Prod, true);

// Key/Password used when accessing the RP Management API.
define("RP_MANAGEMENT_SECRET", "LW4eUhQkJfwJGgQU8JCT/g==", true);

// Idfyed backend environment when accessing the RP Management API.
define("RP_MANAGEMENT_ENDPOINT", Idfyed\RPManagement\Endpoint::Prod, true);
