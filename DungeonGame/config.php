<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id18587062_epiz_31230115');
define('DB_PASSWORD', ']voN3cuO|@)z%6Tz');
define('DB_NAME', 'id18587062_epiz_31230115_test');
 

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 

if($link === false){
    die("ERROR: Nem lehet csatlakozni az adatbázishoz " . mysqli_connect_error());
}
?>