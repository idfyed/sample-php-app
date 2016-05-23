<?php

/*
opyright 2016 (C) Diglias AB

@author jonas

The Diglias GO server will redirect the users browser this URL 
if the user cancels the authentication.

*/

require '../inc/header.php';
?>
  <h1>Canceled</h1>
  <p>Authentication canceled by user</p>
  <a href="/authenticate">Try again</a>
        
<?php require '../inc/footer.php';
?>
  