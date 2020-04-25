<?php include('../../config.php');

    mysqli_query($conn,"TRUNCATE TABLE chat") or die(mysqli_error());
    $command = 0;

    if($command == 0){
        echo "Delete all chat successful!";
    }
    

?>