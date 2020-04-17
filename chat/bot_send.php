<?php
    include('../config.php');
	session_start();
	
	if(isset($_SESSION["userName"]))  {

    
    if(isset($_POST['msg'])){		
		$msg = addslashes($_POST['msg']);
		$msg = strip_tags($_POST['msg']);
        $id = $_POST['id'];
        mysqli_query($conn,"INSERT INTO chat (chat_room_id, chat_msg, userid, chat_date) VALUES ('1', '$msg' , '1', NOW())") or die(mysqli_error());
        
		// mysqli_query($conn,"UPDATE user SET chat_point=chat_point+1 WHERE userName='".$_SESSION['userName']."'")  or die(mysqli_error());
		// $query=mysqli_query($conn,"SELECT * FROM user WHERE userName='".$_SESSION['userName']."'")  or die(mysqli_error());
		// while($row=mysqli_fetch_array($query)){
		// 	$userExp = $row['chat_point'];
		// 	$userLevel = $row['user_level'];
		// 	$max_exp = $row['max_exp'];
		
		// 	if($userExp >= $max_exp){
        //         mysqli_query($conn,"UPDATE user SET user_level=user_level+1 WHERE userName='".$_SESSION['userName']."'")  or die(mysqli_error());
        //         mysqli_query($conn,"UPDATE user SET max_exp=max_exp+'".$userLevel."'*1.5 WHERE userName='".$_SESSION['userName']."'")  or die(mysqli_error());
		// 	}
		
		// }

	}

} else {
	
}
?>
