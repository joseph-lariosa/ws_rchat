<?php
include 'config.php';
include './includes/defaults.inc.php';
session_start();

$userID = $_SESSION['userID'];
$userName = $_SESSION['userName'];
$userRole = $_SESSION['userName'];

if (!isset($_SESSION) || !isset($_SESSION['userName'])) {
	header("Location: /login");
}


$userData = mysqli_query($conn, "SELECT * FROM users WHERE userid=$userID") or die(mysqli_error());
$getUserdata = mysqli_fetch_array($userData);
$banned = $getUserdata['ban_status'];

if ($banned != 1) {
	$_SESSION['u_status'] = 1;
} else {
	header("Location: /login");
	$_SESSION['message'] = "You have been banned";
}



include('template/header.php');
?>

<?php
      if (isset($_GET['del_chatid'])) {
        $chatID = $_GET['del_chatid'];
        $deletemsg = "This message has been removed";
        //mysqli_query($conn,"DELETE FROM chat WHERE chatid='$chatID' ") or die (mysqli_error($conn)); Insta Delete
        mysqli_query($conn, "UPDATE chat SET chat_msg='" . $deletemsg . "',userid=1 WHERE chatid='$chatID' ") or die(mysqli_error($conn));
      }
?>


<script src="js/jquery-chat.js?<?php echo rand(); ?>"></script>
<script src="js/emoji.js?<?php echo rand(); ?>"></script>
<script src="js/slideout.js?<?php echo rand(); ?>"></script>
<script src="player/plyr/plyr.min.js?<?php echo rand(); ?>"></script>
<link rel="stylesheet" href="player/plyr/plyr.css?<?php echo rand(); ?>" crossorigin="anonymous">



<div class="page-wrapper chiller-theme toggled toggled-right">

	<nav id="sidebar" class="sidebar-wrapper">

		<!-- <div class="pl-1 pr-1 text-white">
			<div class="play-details bg-dark py-2 pl-2">
				<div class="d-flex">
					<div class="album-cover" id="song_art"></div>
					<div class="ldr-player mt-2">
						<audio id="player" autoplay>
							<source src="http://172.18.58.14:81/radio/8000/radio.mp3?1587875118" type="audio/mp3">
						</audio>
					</div>
				</div>
				<div class="song-title player-skin1 p-2 mr-2 mt-1">
					<div id="song_details"></div>
				</div>
				<script>
					const player = new Plyr('#player', {
						title: 'Example Title',
						autoplay: true,
					});
				</script>
			</div>
		</div> -->




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
						echo "<li class='nav-item pr-0'><a id='logout-link' class='nav-link pr-0' href='/logout.php'><i class='fa fa-sign-out'></i></a></li>";
					} else {
						echo "<li class='nav-item pr-0'><a class='nav-link pr-0' href='/login.php'><i class='fa fa-sign-in'></i></a></li>";
					}
					?>
				</ul>
			</div>
		</nav>


		<div id="chat_output" class="default_scroll text-white d-flex flex-column-reverse"></div>
		<form id="img-upload" action="./chat/chat_upload.php">
			<input class="chat-file-input" name="file" type="file" id="file" style="display:none;" accept="image/*" />
			<input type="hidden" value="" id="chat_img" />
		</form>

		<form id="chatbox" class="forms pl-1 pr-1 mt-1 form-lg" enctype="multipart/form-data">
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="d-none d-md-block d-lg-block d-xl-block btn btn-warning" id="emoji" type="button">😄</button>
					<button class="btn btn-info text-truncate" style="max-width: 100px" id="file-upload" type="button" onclick="thisFileUpload();"><i class="fa fa-image"></i></button>
				</div>
				<input type="text" id="chat_input" class="form-control input-lg send_chat" placeholder="Say something..." autocomplete="off">
				<input type="hidden" id="1">
				<input type="hidden" id="user_name" value="<?php echo $_SESSION['userName']; ?>">
				<input type="hidden" id="user_id" value="<?php echo $_SESSION['userID']; ?>">
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
<script>
	jQuery(function($) {
		$('#send_msg').on('click', function() {
			<?php if ($banned != 0) { ?>
				window.location.href = './logout.php';
			<?php } ?>
		});
	});

	function thisFileUpload() {
		document.getElementById("file").click();
	};

	$(".chat-file-input").on("change", function() {
		var formData = new FormData();
		formData.append('file', $('#file')[0].files[0]);
		var fileName = $(this).val().split("\\").pop();
		//document.getElementById("chat_input").value = "<img width='100px' id='blah' src='uploads/chat/"+fileName+"' />";




		$.ajax({
			url: 'chat/chat_upload.php',
			type: 'post',
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				if (response != 0) {
					document.getElementById("chat_img").value = response;
					document.getElementById('file-upload').innerHTML = "<img style='max-height:40px' src='uploads/chat/" + response + "'>";
				} else {
					alert('file not uploaded');
				}
			},
		});
	});
</script>

<script src="js/chat.js"></script>
<?php include('template/footer.php'); ?>