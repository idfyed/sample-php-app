<?php

// The COMPANY_NAME is supplied by Diglias when a configuration for a 
// specific customer is set up in the Diglias Go system.
define("COMPANY_NAME","playground",true);

// The MAC_KEY is supplied by Diglias when a configuration for a 
// specific customer is set up in the Diglias Go system. It shoule be 
// used to verify the authenticity of all messages passed to and recived 
// from the Diglias Go server.
define("MAC_KEY","LW4eUhQkJfwJGgQU8JCT/g==",true);

// Diglias backend environment to use for authentication.
define("EAPI_ENDPOINT", Diglias\EAPI\Endpoint::ProdTest, true);
