<?php 
session_start();
// $name = $_FILES['file']['name'];
// 			//$name = md5($name);
// 			$target_dir = "../uploads/chat/";
// 			$target_file = $target_dir . basename($_FILES["file"]["name"]);
		  
//             // Select file type
// 			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          
//             $uploadOk = 1;		   

// 			// Valid file extensions
// 			$extensions_arr = array("jpg","jpeg","png","gif");
		  
// 			// Check extension
// 			if( in_array($imageFileType,$extensions_arr) ){
// 			   // Insert record
// 			//    mysqli_query($conn,"INSERT INTO chat (chat_room_id, chat_msg, userid, chat_date) VALUES ('1', '$img' , '".$_SESSION['userID']."', NOW())") or die(mysqli_error());
		
			
// 			   // Upload file
// 			   move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
		  
//             } else {
//                 $uploadOk = 0;
//             }
            




            /* Getting file name */
            $filename = $_FILES['file']['name'];

            /* Location */
            $location = "../uploads/chat/".$filename;
            $uploadOk = 1;
            $imageFileType = pathinfo($location,PATHINFO_EXTENSION);

            /* Valid Extensions */
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true || isset($_SESSION['isMOD']) && $_SESSION['isMOD'] == true) { 
                $valid_extensions = array("jpg","jpeg","png","gif");
            } else {
                $valid_extensions = array("jpg","jpeg","png");
            }
            /* Check file extension */
            if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
            $uploadOk = 0;
            }

            if($uploadOk == 0){
            echo 0;
            }else{
            /* Upload file */
            if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                echo $location;
            }else{
                echo 0;
            }
            }