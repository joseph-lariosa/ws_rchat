
<?php 

include('../../includes/config.inc.php');
include('../../includes/db.php');

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

if (isset($_POST['radio_settings'])) {

    $azuracast_api = $_POST['api'];
    $radio_url = $_POST['radio_url'];

    $db->query("UPDATE su_settings SET api='{$azuracast_api}',radio_url='{$radio_url}' WHERE id=1");
        header("Location: ../index.php?update=success&api=".$azuracast_api."&".$radio_url."");

    
}