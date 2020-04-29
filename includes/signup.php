<?php session_start();  include('../config.php');

if(isset($_POST['registration'])) {

    $firstName=$_POST['firstname'];
    $lastName=$_POST['lastname'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password2=$_POST['password2'];
    
    $username=strtolower($username);
    // $firstName=strtolower($firstName);
    // $lastName=strtolower($lastName);
    $email=strtolower($email);
    $onlineStatus=0;



    $firstName= mysqli_real_escape_string($conn, $firstName);
    $lastName= mysqli_real_escape_string($conn, $lastName);
    $email= mysqli_real_escape_string($conn, $email);
    $username= mysqli_real_escape_string($conn, $username);
    $password= mysqli_real_escape_string($conn, $password);
    $password2= mysqli_real_escape_string($conn, $password2);



    $query = ("SELECT * FROM users ");
    $select_user_query=mysqli_query($conn,$query);

    if(!$select_user_query){
        die("QUERY FAILED" . mysqli_error($conn));
    } 

    while($row = mysqli_fetch_array($select_user_query)){
        $dbuserId = $row['userid'];
        $dbusername = $row['username'];
        $dbemail = $row['email'];
    }

    if($username === $dbusername && $email !== $dbemail) {
        $_SESSION['message']="The Username is already taken.";
        header('location:../signup/?err=1');
    } elseif ($username !== $dbusername && $email === $dbemail){
        $_SESSION['message']="The Email is already taken.";
        header('location:../signup/?err=2');
    } elseif ($username === $dbusername && $email === $dbemail){
        $_SESSION['message']="Both Email and Username are already taken.";
        header('location:../signup/?err=3');
    } elseif ($password !== $password2){
        $_SESSION['message']="Password did not match";
        header('location:../signup/?err=4');
    } elseif (strlen($password) < 8){
        $_SESSION['message']="Minimum password lenght is 8";
        header('location:../signup/?password_short=8');
    }elseif($username !== $dbusername && $email !== $dbemail){

        $password= md5($password);
        $query = ("INSERT INTO users (email,username,password,firstname,lastname,role,user_level,max_exp) VALUES ('$email','$username','$password','$firstName','$lastName','NEWBIE','1','10')");
        $select_user_query=mysqli_query($conn,$query);
        header('location:../login/?reg_success=1');

    }
}


?>
