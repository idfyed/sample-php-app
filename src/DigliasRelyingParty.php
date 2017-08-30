<?php

/*
* Copyright 2017 (C) Diglias AB
*
* @author jonas
*
* A class that aid in the implementation of the EAPI protocol to
* authenticate users trough the Diglias GO backend.
*
* The API specificaiton can be found @: https://test.diglias.com/doc-rp/eapi.jsp
*
*/

namespace sample;

class DigliasRelyingParty
{

    /*
    * Constructs a RelyingParty object intitializing with information
    * about what server side RP configuration to refer to.
    */
    function __construct($companyName, $macKey, $endpoint = DigliasEndpoint::Prod)
    {
        $this->company_name = $companyName;
        $this->mac_key = $macKey;
        $this->endpoint = $endpoint;
    }

    /**
     * Builds a URL including parameters that the user agent should be redirected
     * to to initiate a authentication transaction.
     */
    public function build_authn_url($params)
    {

        // Add the company name
        $params['auth_companyname'] = $this->company_name;

        // Compute mac and add it to the parameters
        $params['mac'] = $this->compute_mac($params, $this->mac_key);

        // Concatenate the parameters into a string suitable as GET request
        // 	parameters
        $request_params = "";

        foreach ($params as $key => $value) {
            // Use a & to separate the parameters
            if (strlen($request_params) > 0) {
                $request_params = $request_params . "&";
            }

            $request_params = $request_params . $key . "=" . $value;
        }

        return $this->endpoint . "?" . $request_params;
    }

    /**
     *
     * Validates the response from the Diglias Go server by computing
     * a mac and comparing it with the enclosed one.
     *
     * @paramater $params: A associative array of key/value pairs as
     * receieved from the Diglias Go server.
     */
    function verify_authn_response($params)
    {
        $mac = $this->compute_mac($params, $this->mac_key);
        return strcmp($mac, $params['mac']) === 0;
    }

    private $company_name;
    private $mac_key;
    private $endpoint;

    /**
     * Computes a MAC according to the API specification.
     */
    private function compute_mac($params)
    {

        // Sort the parameters alphabetically
        ksort($params);

        $macData = "";

        // Concatenate the parameters into one string
        foreach ($params as $key => $value) {

            // Only params prefixed with "auth_" should be hashed
            if (strpos($key, "auth_") === 0) {

                // Use a & to separate the parameters
                if (strlen($macData) > 0) {
                    $macData = $macData . "&";
                }

                $macData = $macData . $key . "=" . $value;
            }
        }

        // Calculate the MAC
        return strtoupper(hash_hmac("md5", $macData, $this->mac_key));
    }
}

?>