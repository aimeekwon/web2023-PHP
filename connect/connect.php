<?php
$host = "localhost";
$user = "root";
$pw = "root";
$db = "aimee00418";
$connect = new mysqli($host, $user, $pw, $db);
$connect -> set_charset("utf-8");

if(mysqli_connect_errno()){
    echo "Database Connect False";
}else {
    echo "Database Connect True";
}
?>