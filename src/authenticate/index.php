<?php
/*
* Copyright 2016 (C) Diglias AB
*
* @author jonas
*
* Prepare a message to the Diglias GO server and redirect the users
* browser to Diglias GO to ask the user to authentica.
*
*/
    require '../inc/diglias.php';

    // Find out the base URL of the URL:s that the Diglias GO server 
    // will redirect the user to depending on result. The URL:s can not
    // be relative since the call is originating from another server.
    $url_base = ($_SERVER['HTTPS'] ? "https" : "http" ) .
                "://" .
                $_SERVER['SERVER_NAME'] .
                ":" .
                $_SERVER['SERVER_PORT'] .
                "/authenticate/";
    
    
    $RP = new DigliasRelyingParty(COMPANY_NAME, MAC_KEY, DigliasEndpoint::ProdTest );
  
    header('Location: ' . $RP->build_authn_url(
                                DigliasEndpoint::ProdTest,
                                $url_base . "success.php" ,
                                $url_base . "cancel.php",
                                $url_base . "reject.php") ,
                                true,
                                302 );
?>