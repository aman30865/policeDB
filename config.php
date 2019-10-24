<?php

    $mysqlServer = "localhost";
    $mysqlDb = "police";
    $mysqlUser = "root";
    $mysqlPass = "pwdpwd";


    $link = mysqli_connect($mysqlServer, $mysqlUser, $mysqlPass,$mysqlDb) or die("ERROR: Failed to connect to DB : ". mysqli_connect_error());

?>
