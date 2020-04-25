<?php include('../config.php');
session_start();



if(isset($_POST['but_upload'])){
    $username = $_SESSION['userName'];
    $name = $_FILES['file']['name'];
    $name = md5($name);
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
  
    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
    // Valid file extensions

     /* Valid Extensions */
     if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true || isset($_SESSION['isMOD']) && $_SESSION['isMOD'] == true) { 
      $extensions_arr = array("jpg","jpeg","png","gif");
      } else {
            $extensions_arr = array("jpg","jpeg","png");
      }
      
    // Check extension
    if( in_array($imageFileType,$extensions_arr) ){
   
       // Insert record
    mysqli_query($conn,"UPDATE users SET img_url='$name' WHERE username='$username'") or die(mysqli_error());

    
       // Upload file
       move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
       header('location:../index.php?upload=success');
  
    } else {
      header('location:../index.php?no_Change');
    }
   
  }