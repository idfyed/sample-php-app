<?php
/*
* Copyright 2016 (C) Diglias AB
*
* @author jonas
*
* A set of contants and helper functions to aid in the implementation of 
* the EAPI protocoll to authenticate users trough the Diglias GO backend.
* 
* The API specificaiton can be found @: https://test.diglias.com/doc-rp/eapi.jsp
*
*/

// The COMPANY_NAME is supplied by Diglias when a configuration for a 
// specific customer is set up in the Diglias GO system.
define("COMPANY_NAME","playground",true);

// The MAC_KEY is supplied by Diglias when a configuration for a 
// specific customer is set up in the Diglias GO system. It shoule be 
// used to verify the authenticity of all messages passed to and recived 
// from the Diglias GO server.
define("MAC_KEY","LW4eUhQkJfwJGgQU8JCT/g==",true);

// A URL to redirect the users browser to when intiating a authentication
// transaction. Depending on enviroment i can have three different values:
// 
// Production: "https://login.diglias.com/main-eapi/begin"
// Prodtest: "https://prodtest-login.diglias.com/main-eapi/begin"
// Test: "https://test.diglias.com/main-eapi/begin"
//
define("DIGLIAS_BEGIN_URL","https://prodtest-login.diglias.com/main-eapi/begin",true);


/**
* Computes a MAC according to the API specification.
*/

function diglias_compute_mac($params, $mac_key) {
	
	// Sort the parameters alphabetically 
    ksort($params);
	
	$macData = "";
	
	// Concatenate the parameters into one string
    foreach ($params as $key => $value) {
		
        // Only params prefixed with "auth_" should be hashed
        if ( strpos($key, "auth_" ) === 0) {

            // Use a & to separate the parameters
            if ( strlen($macData) > 0 ) {
                $macData = $macData."&";
            }
            
            // Sort the values alphabetically
            $values = explode( ",", $value);
            sort($values);
            
            $macData = $macData.$key."=".implode(",",$values);
            
        }
	}
	
	// 	Calculate the MAC
    return strtoupper(hash_hmac("md5", $macData, $mac_key));
}

/**
* Builds a URL including parameters that the user agent should be redirected
* to to initiate a authentication transaction.
*/

function diglias_build_authn_url( $return_link, $cancel_link, $reject_link){
	
	// 	Set up request parameters
	$params  = array(
		'auth_companyname' => COMPANY_NAME,
		'auth_requestid' => 'XXXXXXX',  // 	Not used in the sample app
		'auth_returnlink' => $return_link,
		'auth_cancellink' => $cancel_link,
		'auth_rejectlink' => $reject_link
		);
	
	$params['mac'] = diglias_compute_mac($params, MAC_KEY );
	
	// 	Concatenate the parameters into a string suitable as GET request 
	// 	parameters
	$request_params = "";
	
	foreach ($params as $key => $value) {
		// 		Use a & to separate the parameters
						if ( strlen($request_params) > 0 ) {
			$request_params = $request_params."&";
		}
		
		$request_params = $request_params.$key."=".$value;
	}
	
	return DIGLIAS_BEGIN_URL."?".$request_params;
}

/**
* Validates the response from the Diglias server by computing a mac and
* comparing it with the enclosed one.
*/

function diglias_verify_authn_response($params) {
    $mac = diglias_compute_mac($params,MAC_KEY);
    return strcmp( $mac, $params['mac'] ) === 0;   
}

?>