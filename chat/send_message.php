<?php
    include('../config.php');
	session_start();

	$cu = $_SESSION['userName'];
	$query = mysqli_query($conn,"SELECT * FROM users WHERE username='{$cu}'")  or die(mysqli_error());

	while($row=mysqli_fetch_array($query)){
		$userExp = $row['chat_point'];
		$userLevel = $row['user_level'];
		$max_exp = $row['max_exp'];
		$isBanned = $row['ban_status'];
	}

	
	if(isset($_SESSION["userName"]))  {

		if($userExp >= $max_exp){
            mysqli_query($conn,"UPDATE users SET user_level=user_level+1 WHERE username='{$cu}'")  or die(mysqli_error());
            mysqli_query($conn,"UPDATE users SET max_exp=max_exp+'".$userLevel."'*1.5 WHERE username='{$cu}'")  or die(mysqli_error());
		}

    
		if(isset($_POST['msg']) && $isBanned != 1){		
			$msg = addslashes($_POST['msg']);
			$msg = strip_tags($_POST['msg']);
			$id = $_POST['id'];
			mysqli_query($conn,"INSERT INTO chat (chat_room_id, chat_msg, userid, chat_date) VALUES ('1', '$msg' , '".$_SESSION['userID']."', NOW())") or die(mysqli_error());
			mysqli_query($conn,"UPDATE users SET chat_point=chat_point+1 WHERE username='{$cu}'")  or die(mysqli_error());
		}
	
	}
?>
