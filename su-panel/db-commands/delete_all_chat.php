<?php 

include('../../includes/config.inc.php');
include('../../includes/db.php');

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

    $db->query("TRUNCATE TABLE chat") or die(mysqli_error());
    $command = 0;

    if($command == 0){
        echo "Delete all chat successful!";
    }
    

?>