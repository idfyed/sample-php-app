<?php
/**
 * Copyright 2017 (C) Diglias AB
 *
 * @author jonas
 *
 * Utility functions
 *
 */

namespace sample;

class Util
{
    /**
     *
     * Generate a string with random characters.
     *
     * @param int $length - Number of characters to generate - defaults to 16.
     * @return string
     */
    static function generateRandomString($length = 16)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     *
     * Find out the base URL of the URL:s that the Diglias GO server
     * will redirect the user to depending on result. The URL:s can not
     * be relative since the call is originating from another server.
     *
     * @param $path
     * @return string - The absolute URL
     */
    static function buildEndpointURL($path)
    {

        return ($_SERVER['HTTPS'] ? "https" : "http") .
            "://" .
            $_SERVER['SERVER_NAME'] .
            ":" .
            $_SERVER['SERVER_PORT'] .
            $path;
    }


    /**
     * Keeps track of request id that have been used, and register new ones.
     *
     * @param $id
     * @return boolean - False is the session id has been used before.
     */
    static function validateRequestId($id) {

        // Alwayes returns true to simplify the sample application.
        // In a production application the request id should be stored in persistent storage
        // available to all requests.
        // I would also require some kind of clean up mechanism.

        return true;
    }

}
