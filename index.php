<?php
include './config.php';
session_start();

$userID = $_SESSION['userID'];
$userName = $_SESSION['userName'];
$userRole = $_SESSION['userName'];

   if (!isset($_SESSION) || !isset($_SESSION['userName'])) {
         header("Location: login.php");
   }


   $userData = mysqli_query($conn, "SELECT * FROM users WHERE userid=$userID") or die(mysqli_error());
   $getUserdata = mysqli_fetch_array($userData);
   $banned = $getUserdata['ban_status'];

   if($banned != 1){
	   $_SESSION['u_status'] = 1;
	}else{
	   header("Location: login.php");
	   $_SESSION['message'] = "You have been banned";
   }
 
include('template/header.php');
?>

<script src="js/jquery-chat.js?<?php echo rand(); ?>"></script>
<script src="js/emoji.js?<?php echo rand(); ?>"></script>
<script src="js/slideout.js?<?php echo rand(); ?>"></script>




<div class="page-wrapper chiller-theme toggled toggled-right">

	<nav id="sidebar" class="sidebar-wrapper">

		<div class="p-2 text-white">
			<h5>On Air</h5>
			<!-- <iframe src="http://172.17.148.56/public/streamchat/embed" frameborder="0" allowtransparency="true" style="width: 100%; min-height: 150px; border: 0;"></iframe> -->
		</div>

		<div class="sidebar-content">


		</div>
	</nav>


	<!-- sidebar-wrapper  -->
	<main class="page-content">
		<nav class="navbar navbar-expand navbar-dark bg-dark-blue fixed-top">
			<a class="navbar-brand" href="#">StreamChat</a>
			<button class="navbar-toggler mr-0" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="navbar-collapse mr-0" id="navbarsExampleDefault">
				<ul class="nav navbar-nav mx-auto chat-nav-icons">
					<li class="nav-item"><a href="#" class="nav-link" id="toggle-sidebar"><i class="fa fa-music"></i></a></li>
					<li class="nav-item"><a href="#" class="nav-link" id="toggle-sidebar-right"><i class="fa fa-user" aria-hidden="true"></i></a></li>
				</ul>
				<ul class="nav navbar-nav mr-0 chat-nav-icons">
					<?php
					if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
						echo "<li class='nav-item pr-0'><a class='nav-link pr-0' href='/logout.php'><i class='fa fa-sign-out'></i></a></li>";
					} else {
						echo "<li class='nav-item pr-0'><a class='nav-link pr-0' href='/login.php'><i class='fa fa-sign-in'></i></a></li>";
					}
					?>
				</ul>
			</div>
		</nav>


		<div id="chat_output" class="default_scroll text-white d-flex flex-column-reverse"></div>


		<form id="chatbox" class="forms pl-1 pr-1 mt-1 form-lg">
			<div class="input-group">
				<div class="input-group-prepend d-none d-md-block d-lg-block d-xl-block">
					<button class="btn btn-warning" id="emoji" type="button">😄</button>
				</div>
				<input type="text" id="chat_input" class="form-control input-lg" placeholder="Say something..." autocomplete="off">
				<input type="hidden" id="1">
				<input type="hidden" id="user_name" value="<?php echo $_SESSION['userName'];?>">
				<input type="hidden" id="user_id" value="<?php echo $_SESSION['userID'];?>">
				<div class="input-group-append">
					<button class="btn btn-primary" id="send_msg" type="submit">
						<i class="fa fa-paper-plane" aria-hidden="true"></i>
					</button>
				</div>
		</form>

</div>


</main>
<!-- page-content" -->



<nav id="sidebar-right" class="sidebar-right-wrapper">

	<div class="sidebar-right-content">


		<div id="widget-right"></div>

	</div>
	<!--sidebar-wrapper-->


</nav>


</div>
<!-- page-wrapper -->


<script src="js/chat.js"></script>
<?php include('template/footer.php'); ?>