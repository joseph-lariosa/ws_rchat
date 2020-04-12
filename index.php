<?php
include './config.php';
session_start();

$userID = $_SESSION['userID'];
$userName = $_SESSION['userName'];
$userRole = $_SESSION['userName'];

   if (!isset($_SESSION) || !isset($_SESSION['userName'])) {
         header("Location: login.php");
   }

include('template/header.php');
?>

<script src="js/jquery-chat.js?<?php echo rand(); ?>"></script>
<script src="js/emoji.js?<?php echo rand(); ?>"></script>
<script src="js/slideout.js?<?php echo rand(); ?>"></script>

<div class="page-wrapper chiller-theme toggled">

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
						echo "<li class='nav-item'><a class='nav-link' href='" . $base_url . "/logout.php'><i class='fa fa-sign-out'></i></a></li>";
					} else {
						echo "<li class='nav-item'><a class='nav-link' href='" . $base_url . "/login.php'><i class='fa fa-sign-in'></i></a></li>";
					}
					?>
				</ul>
			</div>
		</nav>


		<div id="chat_output" class="scroll_lock default_scroll text-white">

			<?php $query = mysqli_query($conn, "SELECT * FROM chat LEFT JOIN `users` ON users.userid=chat.userid WHERE chat_room_id='1' ORDER BY chat_date DESC LIMIT 40 ") or die(mysqli_error());
			while ($row = mysqli_fetch_array($query)) {
			?>


				<div class="chat-entry card p-1 m-1">
					<div class="row">
						<div class="col-md-12">
							<div class="text-muted float-right d-flex">
								<div class="time-stamp-h">
									<i class="fa fa-clock-o" title="<?php echo date("l,h:m A", strtotime($row['chat_date'])); ?>"></i>
								</div>
							</div>
							<div class="d-flex">

								<div class="c-left mr-2">
									<div class="dp-wrapper">
										<a href="#" data-toggle="modal" data-target="#<?php echo $row["username"]; ?>">
											<img class="rounded" src="<?php if ($row['img_url'] != '') { echo "uploads/" . $row['img_url'] . ""; } else {echo "images/default-person.png";} ?>">
										</a>
									</div>
									<span class="mt-1 d-block badge badge-<?php echo $row['role']; ?>"><?php echo $row['role']; ?></span>
								</div>


								<div class="c-right">
									<a href="#" class="text-white font-weight-bold" id="us" onclick="changeValue(this)"><?php echo $row['username']; ?></a><br><?php echo $row['chat_msg']; ?>
								</div>
							</div>
						</div>
					</div>
				</div>


			<?php } ?>

		</div>


		<form id="chatbox" class="forms pl-1 pr-1 mt-1 form-lg">
			<div class="input-group">
				<div class="input-group-prepend d-none d-md-block d-lg-block d-xl-block">
					<button class="btn btn-warning" id="emoji" type="button">😄</button>
				</div>
				<input type="text" id="chat_input" class="form-control input-lg" placeholder="Say something..." autocomplete="off">
				<input type="hidden" id="1">
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

		// Websocket
		var websocket_server = new WebSocket("ws://localhost:8080/");

		websocket_server.onopen = function(e) {
			$('#widget-right').load('chat/widget-right.php');
			console.log("Connection established!");
			websocket_server.send(
				JSON.stringify({
					'type': 'socket',
					'user_id': <?php echo $userID; ?>,
					'user_name': "<?php echo $userName; ?>"
				})
			);
		};

		websocket_server.onclose = function(e) {
			$('#widget-right').load('chat/widget-right.php');
			console.log("User Disconnected");
		};

		websocket_server.onerror = function(e) {
			// Errorhandling
		}
		websocket_server.onmessage = function(e) {
			$('#widget-right').load('chat/widget-right.php');
			var json = JSON.parse(e.data);
			console.log(e.data);
			switch (json.type) {
				case 'chat':
					$('#chat_output').append(json.msg);
					autoScrolling();
					break;
			}
		}


		$('#send_msg').on('click', function() {
			if ($('#chat_input').val() == "") {
				alert('Please write message first');
				event.preventDefault();

			} else {
				event.preventDefault();
				var chat_msg = $('#chat_input').val();
				var room_id = $('#room_id').val();
				websocket_server.send(
					JSON.stringify({
						'type': 'chat',
						'user_id': <?php echo $userID; ?>,
						'user_name': "<?php echo $userName; ?>",
						'chat_msg': chat_msg
					})
				);
				$.ajax({
					type: "POST",
					url: "chat/send_message.php",
					data: {
						msg: chat_msg,
						id: room_id,
					},
					success: function() {
						autoScrolling_msg();
					}
				});
				$("input[type='text']").val('');
			}
		});
	});
</script>

<?php include('template/footer.php'); ?>