<?php

    $mysqlServer = "localhost";
    $mysqlDb = "id11443912_policedb";
    $mysqlUser = "id11443912_root";
    $mysqlPass = "Aman@1999";


    $link = mysqli_connect($mysqlServer, $mysqlUser, $mysqlPass,$mysqlDb) or die("ERROR: Failed to connect to DB :here ". mysqli_connect_error());

?>
