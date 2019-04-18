<?php

/**
 * Copyright 2019 (C) IDFyed Solutions AB
 *
 * @author jonas
 *
 * A class that aid in the implementation of the EAPI protocol to
 * authenticate users trough the IDFyed GO backend.
 *
 * The API specification can be found @: https://test.idfyed.com/doc-rp/eapi.jsp
 *
 */

namespace IdFyed\EAPI;

class RelyingParty
{

    /*
    * Constructs a RelyingParty object initializing with information
    * about what server side RP configuration to refer to.
    */
    function __construct($companyName, $macKey, $endpoint = Endpoint::Prod)
    {
        $this->company_name = $companyName;
        $this->mac_key = $macKey;
        $this->endpoint = $endpoint;
    }

    /**
     * Builds a URL including parameters that the user agent should be redirected
     * to to initiate a authentication transaction.
     */
    public function buildAuthnURL($params)
    {

        // Add the company name
        $params['auth_companyname'] = $this->company_name;

        // Compute mac and add it to the parameters
        $params['mac'] = RelyingParty::computeMac($params, $this->mac_key);

        // URL Encode parameter values and concatenate the parameters into a string suitable
        // as GET request parameters
        $request_params = "";

        foreach ($params as $key => $value) {
            // Use a & to separate the parameters
            if (strlen($request_params) > 0) {
                $request_params = $request_params . "&";
            }

            $request_params = $request_params . $key . "=" . urlencode($value);
        }

        return $this->endpoint . "?" . $request_params;
    }

    /**
     *
     * Validates the response from the IDFyed Go server by computing
     * a mac and comparing it with the enclosed one.
     *
     * @paramater $params: A associative array of key/value pairs as
     * received from the IDFyed Go server.
     */
    function verifyAuthnResponse($params)
    {
        $mac = RelyingParty::computeMac($params, $this->mac_key);
        return strcmp($mac, $params['mac']) === 0;
    }

    /**
     * Computes a MAC according to the API specification.
     */
    static function computeMac($params, $macKey)
    {

        // Sort the parameters alphabetically
        ksort($params);

        $macData = "";

        // Concatenate the parameters into one string
        // Since $_POST overwrites variables with same name, then the multiple values for one attribute is not needed for php implementation.
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
        return strtoupper(hash_hmac("md5", $macData, $macKey));
    }

    private $company_name;
    private $mac_key;
    private $endpoint;
}

?>
