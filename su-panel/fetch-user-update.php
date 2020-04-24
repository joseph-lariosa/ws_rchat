<?php   include('../config.php');

    if(isset($_POST['user_meta_su'])){

        $cu = $_POST['cu'];

        // $dbUserbio = $_POST['bio'];
        // $dbUserfb = $_POST['fb'];
        // $dbUsertw = $_POST['tw'];
        // $dbUserig = $_POST['ig'];

        // $dbUserbio = strip_tags($dbUserbio);
        // $dbUserfb = strip_tags($dbUserfb);
        // $dbUsertw = strip_tags($dbUsertw);
        // $dbUserig = strip_tags($dbUserig);



        // $dbUserbio= mysqli_real_escape_string($conn, $dbUserbio);
        // $dbUserfb= mysqli_real_escape_string($conn, $dbUserfb);
        // $dbUsertw= mysqli_real_escape_string($conn, $dbUsertw);
        // $dbUserig= mysqli_real_escape_string($conn, $dbUserig);


        $fn = $_POST['firstname'];
        $ln = $_POST['lastname'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $ban = $_POST['ban_status'];


        $fn = strip_tags($fn);
        $ln = strip_tags($ln);


        $fn= mysqli_real_escape_string($conn, $fn);
        $ln= mysqli_real_escape_string($conn, $ln);
        $role= mysqli_real_escape_string($conn, $role);
   

        if($fn != ''){
            mysqli_query($conn,"UPDATE users SET firstname='{$fn}' WHERE username='{$cu}'");
        } 

        if($ln != ''){
            mysqli_query($conn,"UPDATE users SET lastname='{$ln}' WHERE username='{$cu}'");
        }

        if($ln != ''){
            mysqli_query($conn,"UPDATE users SET lastname='{$ln}' WHERE username='{$cu}'");
        }

        if($email != ''){
            mysqli_query($conn,"UPDATE users SET email='{$email}' WHERE username='{$cu}'");
        }


       
        if($role != ''){
            mysqli_query($conn,"UPDATE users SET role='{$role}' WHERE username='{$cu}'");
        }


        
        if($ban === '1'){
            mysqli_query($conn,"UPDATE users SET ban_status=1 WHERE username='{$cu}'");
        }

        if($ban === '0'){
            mysqli_query($conn,"UPDATE users SET ban_status=0 WHERE username='{$cu}'");
        }
   
        // if($dbUserbio != ''){
        //     mysqli_query($conn,"UPDATE users SET bio='{$dbUserbio}' WHERE username='{$cu}'");
        // }else{
        //     mysqli_query($conn,"UPDATE users SET bio='{$dbUserbio}' WHERE username='{$cu}'");
        // }

        // if($dbUserfb != ''){
        //     mysqli_query($conn,"UPDATE users SET fb='{$dbUserfb}' WHERE username='{$cu}'");
        // }else{
        //     mysqli_query($conn,"UPDATE users SET fb='{$dbUserfb}' WHERE username='{$cu}'");

        // }

        // if($dbUsertw != ''){
        //     mysqli_query($conn,"UPDATE users SET tw='{$dbUsertw}' WHERE username='{$cu}'");
        // }else{
        //     mysqli_query($conn,"UPDATE users SET tw='{$dbUsertw}' WHERE username='{$cu}'");
        // }

        // if($dbUserig != ''){
        //     mysqli_query($conn,"UPDATE users SET ig='{$dbUserig}' WHERE username='{$cu}'");
        // }else{
        //     mysqli_query($conn,"UPDATE users SET ig='{$dbUserig}' WHERE username='{$cu}'");
        // }

       

        header("Location: index.php?user_update=success");
    } else {
        header("Location: index.php?user_update=failed?error");
    }


