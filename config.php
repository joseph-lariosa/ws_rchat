<?php

$db['host'] = "localhost";
$db['username'] = "root";
$db['password'] = "";
$db['database'] = "rchat";
$base_url= 'http://localhost/rchat/';
$sitename= 'StreamChat';


//MySQLi Procedural
$conn = mysqli_connect($db['host'],$db['username'],$db['password'],$db['database']);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
 
?>

