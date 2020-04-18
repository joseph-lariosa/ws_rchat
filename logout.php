<?php include('config.php');
session_start();
$username = $_SESSION['userName'];
mysqli_query($conn,"UPDATE users SET login_status=0 WHERE username='$username'");
 session_unset();
 session_destroy();
 header('location:index.php');
 ?>