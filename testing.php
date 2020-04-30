<?php include('includes/db.php');

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'rchat';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

$getRadio = $db->query('SELECT * FROM su_settings WHERE id = 1')->fetchArray();



echo $getRadio['api'];