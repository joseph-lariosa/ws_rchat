<?php

if (isset($_POST["reset-password-submit"])) {

    $selector = $_POST["selector"];
    $validator = bin2hex($_POST["validator"]);
    $password = $_POST["password"];
    $password2 = $_POST["password2"];



    if (empty($password) || empty($password2)) {
        header("Location: ../forgot-password/create-new-password.php?newpwd=empty");
        exit();
    } else if ($password !== $password2) {
        header("Location: ../forgot-password/create-new-password.php?newpwd=passnotsame");
        exit();
    }

    $currentDate = date("U");

    include('../config.php');


    $query = ("SELECT * FROM pwdreset WHERE pwdResetSelector='{$selector}' AND pwdResetExpires >='{$currentDate}'");
    $select_user_query = mysqli_query($conn, $query);

    if (!$select_user_query) {
        die("QUERY FAILED" . mysqli_error($conn));
    }

    
    while ($row = mysqli_fetch_array($select_user_query)) {
        $pwdResetToken = $row['pwdResetToken'];
        $expires = $row['pwdResetExpires'];
        $pwdResetEmail = $row['pwdResetEmail'];
    }

    if($currentDate >= $expires){
        header("Location: ../forgot-password/?token-expired");

        $query = ("DELETE FROM pwdreset WHERE pwdResetExpires='{$expires}'");
        $select_user_query = mysqli_query($conn, $query);
    
        if (!$select_user_query) {
          die("QUERY FAILED" . mysqli_error($conn));
        }
    

    } else if ($pwdResetToken === ''){
        header("Location: ../forgot-password/?invalid-Token");
    }


    

    $token =  hex2bin($validator);
    $token = stripslashes($token);

    // echo utf8_decode($token)."<br>";
    // echo $pwdResetToken;

    if ($token === $pwdResetToken){

        $new_password = md5($password);
        $new_password = mysqli_real_escape_string($conn,$new_password);

        $user_email = $pwdResetEmail;

        $query = ("UPDATE users SET password='{$new_password}' WHERE email='{$user_email}'");
        $select_user_query = mysqli_query($conn, $query);

        if (!$select_user_query) {
            die("QUERY FAILED <Br>" . mysqli_error($conn));
        }

        $query = ("DELETE FROM pwdreset WHERE pwdResetEmail='{$user_email}'");
        $select_user_query = mysqli_query($conn, $query);
    
        if (!$select_user_query) {
          die("QUERY FAILED" . mysqli_error($conn));
        }
    
        

        header("Location: ../login/?reset=success");

    } else {


        $query = ("DELETE FROM pwdreset WHERE pwdResetSelector='{$selector}'");
        $select_user_query = mysqli_query($conn, $query);
    
        if (!$select_user_query) {
          die("QUERY FAILED" . mysqli_error($conn));
        }

        session_start();
        $_SESSION['message']="Sorry something went wrong please try again.";
        header("Location: ../forgot-password/?token-missmatch");
        
        


    }


} else {
    header("Location: ../index.php");
}
