<?php include('../../config.php');?>
<?php
  if(isset($_POST['ban'])){		

    $user=$_POST['user_to_ban'] ;

    mysqli_query($conn,"UPDATE users SET ban_status=0 WHERE username='{$user}'")  or die(mysqli_error());


  }