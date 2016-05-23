<?php
/*
Copyright 2016 (C) Diglias AB

@author jonas

The Diglias GO server will redirect the users browser to POST to this URL 
once the authenitcation has been sucessfullty completed.

*/
    require '../inc/header.php';
    require '../inc/diglias.php';

    if ( diglias_verify_authn_response($_POST) ) {
?>
    <h1>Success</h1>
    <p>Authenticaton sucessful</p>
    <table>
        <tr>
            <th>Parameter</th>
            <th>Value</th>
        </tr>
       <?php foreach ($_POST as $key => $value) { ?>
        <tr>
            <td><?= $key ?></td>
            <td><?= $value ?></td>
        </tr>
       <?php } ?>
    </table>
    <p></p>   
        <a href="/authenticate">Authenticate again</a>
<?php
    } else {
?>
      <h1>Login failed</h1>
  <p>MAC could not be validated.</p>
  <p> <a href="/authenticate">Try again</a></p>
<?php 
    }

require '../inc/footer.php';
?>
  