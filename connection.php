<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "GYMdb";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	print "Connectin Created";
	die("failed to connect!");
}

?>
