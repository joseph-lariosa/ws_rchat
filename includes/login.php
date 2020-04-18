<?php
include '../config.php';
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = strtolower($username);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $query = ("SELECT * FROM users WHERE username='{$username}' and password='$password'");
    $select_user_query = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($select_user_query)) {
        $dbuserid = $row['userid'];
        $dbusername = $row['username'];
        $dbpassword = $row['password'];
        // $dbUserStatus = $row['online_status'];
        // $dbUserBanStatus = $row['ban_status'];
        $dbrole = $row['role'];
    }


    if ($username !== $dbusername && $password !== $dbpassword) {
        $_SESSION['message'] = "Either the username or password is incorrect. Please Try Again";
        header('location:/login.php');
    } else {
        mysqli_query($conn, "UPDATE users SET login_status=1,last_login=NOW() WHERE username='$username'");
        $_SESSION['userID'] = $dbuserid;
        $_SESSION['userName'] = $dbusername;
        $_SESSION['loggedIn'] = "TRUE";
        $_SESSION['userRole'] = $dbrole;
        if($dbrole == 'ADMIN'){
            $_SESSION['isAdmin'] = "TRUE";
        }
        header('location:/index.php');
    }
}
?>
