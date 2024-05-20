<?php

$host = "localhost" ;
$user =  "root" ;
$password = "";
$dbname = "eraasoft_crud" ;

$conn =  mysqli_connect($host,$user,$password,$dbname );
if (!$conn) {
    echo "connect error " . mysqli_connect_error($conn);
}