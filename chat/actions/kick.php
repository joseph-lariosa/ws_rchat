<?php include('../../config.php');?>
<?php
  if(isset($_POST['kick'])){		

    $user=$_POST['user_to_kick'] ;

    mysqli_query($conn,"UPDATE users SET kick=1,login_status=0 WHERE username='{$user}'")  or die(mysqli_error());

  }