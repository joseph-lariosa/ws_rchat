<?php 
include '../config.php';
session_start();

if(isset($_POST['login'])) {
    $username=$_POST['username'];
    $password=$_POST['password'];
    $username=strtolower($username);
    $username= mysqli_real_escape_string($conn, $username);
    $password= mysqli_real_escape_string($conn, $password);
    $query = ("SELECT * FROM users WHERE username='{$username}' and password='$password'");
    $select_user_query=mysqli_query($conn,$query);

    while($row = mysqli_fetch_array($select_user_query)){
        $dbuserid = $row['userid'];
        $dbusername = $row['username'];
        $dbpassword = $row['password'];
        // $dbUserStatus = $row['online_status'];
        // $dbUserBanStatus = $row['ban_status'];
        $dbrole = $row['role'];
    }


    if($username !== $dbusername && $password !== $dbpassword){
        $_SESSION['message']="Either the username or password is incorrect. Please Try Again";
        header('location:/login.php');

    }else{
        mysqli_query($conn,"UPDATE users SET login_status=1 WHERE username='$username'");
 
        $_SESSION['userID']=$dbuserid;
        $_SESSION['userName']=$dbusername;
        $_SESSION['loggedIn']="TRUE";
        $_SESSION['userRole']=$dbrole;

        header('location:/index.php');
    }

}
?>



<script>
    	jQuery(function($) {
		// Websocket
		var websocket_server = new WebSocket("ws://rchat.test:8080/");

		websocket_server.onopen = function(e) {
		

			var user_name = $('#user_name').val();
			websocket_server.send(
				JSON.stringify({
					'type': 'chat',
					'user_id': 1,
					'user_name': 'admin',
					'chat_msg': user_name + ' has joined chat'
                }))
		
		};
    	
                
            });
</script>