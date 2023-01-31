<?php

$host = "localhost";
$database = "laptop_store";
$username = "root";
$password = "";
//connecting to the database
$connection = mysqli_connect($host,$username,$password,$database)
or die("Database cannot connect");