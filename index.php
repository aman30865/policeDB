<?php

$mysqlServer = "localhost";
$mysqlDb = "test";
$mysqlUser = "root";
$mysqlPass = "pwdpwd";

$conn = mysqli_connect($mysqlServer, $mysqlUser, $mysqlPass) or die("failed to connect to db");
mysqli_select_db($conn, $mysqlDb) or die("failed to connect select db");



?>