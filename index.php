<?php
include './config.php';

session_start();



$userID = $_SESSION['userID'];
$userName = $_SESSION['userName'];
$userRole = $_SESSION['userName'];





?>
<!DOCTYPE html>
<html>
<head>
	<title>Chat</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<script src="js/jquery.js" type="text/javascript"></script>
	<style type="text/css">
	* {margin:0;padding:0;box-sizing:border-box;font-family:arial,sans-serif;resize:none;}
	html,body {width:100%;height:100%;}
	#wrapper {position:relative;margin:auto;max-width:1000px;height:100%;}
	#chat_output {position:absolute;top:0;left:0;padding:20px;width:100%;height:calc(100% - 100px);}
	#chat_input {position:absolute;bottom:0;left:0;padding:10px;width:100%;height:100px;border:1px solid #ccc;}
	</style>
</head>
<body>
	<div id="wrapper">
		<div id="chat_output">
			
		<?php $query=mysqli_query($conn,"SELECT * FROM chat LEFT JOIN `users` ON users.userid=chat.userid WHERE chat_room_id='1' ORDER BY chat_date DESC LIMIT 5 ") or die(mysqli_error());
			while($row=mysqli_fetch_array($query)){
			?>	

			
					<div class="chat-entry card p-1 m-1">
						<div class="row">
							<div class="col-md-12">
								<div class="text-muted float-right d-flex">
									<div class="time-stamp-h">
										<i class="fa fa-clock-o" title="<?php echo date("l,h:m A",strtotime($row['chat_date'])); ?>"></i> 
									</div>
									
								
								</div>
								<div class="d-flex">
					
									<div class="c-right">
										<a href="#" class="text-white font-weight-bold"  id="us" onclick="changeValue(this)"><?php echo $row['username']; ?></a><br><?php echo $row['chat_msg']; ?>
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


		<script type="text/javascript">
			jQuery(function($){
			// Websocket
			var websocket_server = new WebSocket("ws://localhost:8080/");

			websocket_server.onopen = function(e) {
				console.log("Connection established!");
				websocket_server.send(
					JSON.stringify({
						'type':'socket',
						'user_id':<?php echo $userID; ?>,
						'user_name': "<?php echo $userName;?>"
					})
				);
			};
			websocket_server.onerror = function(e) {
				// Errorhandling
			}
			websocket_server.onmessage = function(e)
			{
				var json = JSON.parse(e.data);
				console.log(e.data);
				switch(json.type) {
					case 'chat':
						$('#chat_output').append(json.msg);
						break;
				}
			}
			

			$('#send_msg').on('click', function () {
				if ($('#chat_input').val() == "") {
					alert('Please write message first');
					event.preventDefault();

				} else {
					event.preventDefault();
					var chat_msg = $('#chat_input').val();
					var room_id = $('#room_id').val();
					websocket_server.send(
						JSON.stringify({
							'type':'chat',
							'user_id':<?php echo $userID; ?>,
							'user_name': "<?php echo $userName;?>",
							'chat_msg':chat_msg
						})
					);
					$.ajax({
						type: "POST",
						url: "chat/send_message.php",
						data: {
							msg: chat_msg,
							id: room_id,
						},
						success: function () {
						
							
						}
					});
					$("input[type='text']").val('');
				}
			});
		});
		</script>
	</div>
</body>
</html>