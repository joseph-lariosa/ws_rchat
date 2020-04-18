<?php include('../config.php');?>
<?php session_start();

$pu = $_GET['profile'];
$username = $pu;

$userData = mysqli_query($conn, "SELECT * FROM users WHERE username='{$username}'") or die(mysqli_error());
$getUserdata = mysqli_fetch_array($userData);

if ($getUserdata != ''){
    $profile_username = $getUserdata['username'];
} else {
    header('location:../404.php');
}


echo $profile_username;

