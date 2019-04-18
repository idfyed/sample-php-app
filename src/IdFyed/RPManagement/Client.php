<?php

/**
 * Copyright 2019 (C) IDFyed Solutions AB
 *
 * @author jonas
 *
 * A class that wraps communication to the IDFyed RP Management API.
 *
 * The API specification can be found @: https://test.idfyed.com/doc-rp/rp-mgmt.jsp
 *
 */

namespace IdFyed\RPManagement;


class Client
{


    /**
     * Constructs a immutable client object that can communicate with the RPManagement API. The class relys on the curl
     * module witch needs to be enabled.
     *
     * @param $companyName - The RP company name from the IDFyed configuration
     * @param $username - Username for authentication
     * @param $secret - Password for authentication
     * @param $endpoint - Endpoint select a value from RPManagement\Endpoint
     */
    public function __construct($companyName, $username, $secret, $endpoint)
    {
        $this->companyName = $companyName;
        $this->username = $username;
        $this->secret = $secret;
        $this->endpoint = $endpoint;
    }

    /**
     *
     * Sends a request to the IDFyed service to add a attribute value to the given users IDFyed profile.
     *
     * @param $userId - ID of the user as returned in a earlier interaction where the user was authenticated by IDFyed.
     * @param $attributeName - Name of the attribute to add.
     * @param $attributeValue - Value to add
     * @return mixed - 204 on success, all other values indicate failure, the value is to be interpreted as a HTTP
     * status code.
     */
    public function add($userId, $attributeName, $attributeValue)
    {

        $body = '{ "action": "ADD", "attributes": [ { "name": "' . $attributeName . '", "value" : "' . $attributeValue . '" } ] }';

        return $this->sendRequest($userId, $body);
    }


    private function sendRequest($userid, $body)
    {
        $url = $this->endpoint . $this->companyName . '/' . $userid;

        $headers = [
            'Content-Type: application/json',
            "Authorization: Basic " . base64_encode($this->username . ":" . $this->secret)
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $resultCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return $resultCode;

    }

    private $companyName;
    private $username;
    private $secret;
    private $endpoint;
}
