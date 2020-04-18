<?php include('../config.php');

    session_start();
    $cu = $_SESSION['userName'];





    if(isset($_POST['user_meta'])){
        $dbUserbio = $_POST['bio'];
        $dbUserfb = $_POST['fb'];
        $dbUsertw = $_POST['tw'];
        $dbUserig = $_POST['ig'];

        $dbUserbio = strip_tags($dbUserbio);
        $dbUserfb = strip_tags($dbUserfb);
        $dbUsertw = strip_tags($dbUsertw);
        $dbUserig = strip_tags($dbUserig);



        $dbUserbio= mysqli_real_escape_string($conn, $dbUserbio);
        $dbUserfb= mysqli_real_escape_string($conn, $dbUserfb);
        $dbUsertw= mysqli_real_escape_string($conn, $dbUsertw);
        $dbUserig= mysqli_real_escape_string($conn, $dbUserig);


        $fn = $_POST['firstname'];
        $ln = $_POST['lastname'];
        $fn = strip_tags($fn);
        $ln = strip_tags($ln);
        $fn= mysqli_real_escape_string($conn, $fn);
        $ln= mysqli_real_escape_string($conn, $ln);

        if($fn != ''){
            mysqli_query($conn,"UPDATE users SET firstname='{$fn}' WHERE username='{$cu}'");
        } 

        if($ln != ''){
            mysqli_query($conn,"UPDATE users SET lastname='{$ln}' WHERE username='{$cu}'");
        }


   
        if($dbUserbio != ''){
            mysqli_query($conn,"UPDATE users SET bio='{$dbUserbio}' WHERE username='{$cu}'");
        }else{
            mysqli_query($conn,"UPDATE users SET bio='{$dbUserbio}' WHERE username='{$cu}'");
        }

        if($dbUserfb != ''){
            mysqli_query($conn,"UPDATE users SET fb='{$dbUserfb}' WHERE username='{$cu}'");
        }else{
            mysqli_query($conn,"UPDATE users SET fb='{$dbUserfb}' WHERE username='{$cu}'");

        }

        if($dbUsertw != ''){
            mysqli_query($conn,"UPDATE users SET tw='{$dbUsertw}' WHERE username='{$cu}'");
        }else{
            mysqli_query($conn,"UPDATE users SET tw='{$dbUsertw}' WHERE username='{$cu}'");
        }

        if($dbUserig != ''){
            mysqli_query($conn,"UPDATE users SET ig='{$dbUserig}' WHERE username='{$cu}'");
        }else{
            mysqli_query($conn,"UPDATE users SET ig='{$dbUserig}' WHERE username='{$cu}'");
        }
        

        header('location:/index.php');

    }


