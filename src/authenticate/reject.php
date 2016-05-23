<?php
/*
* Copyright 2016 (C) Diglias AB
*
* @author jonas
*
* The Diglias GO server will redirect the users browser this URL 
* if the authentication gets rejected by the Diglias GO server.
*
*/

require '../inc/header.php';
?>
    <h1>Rejected</h1>
    <p>Authentication rejected by server</p>
    <p><em>Error code:&nbsp;</em> <?= $_GET['error_code'] ?></p>
    <p><em>Error message:&nbsp;</em> <?= $_GET['error_message'] ?></p>
    <p><a href="/authenticate">Try again</a>

<?php require '../inc/footer.php';
?>  
 