
  	jQuery(function($) {
		// Websocket
		var websocket_server = new WebSocket("ws://rchat.test:8080/");

		websocket_server.onopen = function(e) {
			$('#widget-right').load('chat/widget-right.php');
			$('#chat_output').load('chat/ce.php');
			autoScrolling();

		};

		websocket_server.onclose = function(e) {
			
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
					$('#chat_output').prepend(json.msg);
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
                var user_name = $('#user_name').val();
                var user_id = $('#user_id').val();
				websocket_server.send(
					JSON.stringify({
						'type': 'chat',
						'user_id': user_id,
						'user_name': user_name,
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



			
	



					function setCookie(c_name,value,exdays){var exdate=new Date();exdate.setDate(exdate.getDate() + exdays);var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());document.cookie=c_name + "=" + c_value;}
					function getCookie(c_name){var c_value = document.cookie;var c_start = c_value.indexOf(" " + c_name + "=");if (c_start == -1){c_start = c_value.indexOf(c_name + "=");}if (c_start == -1){c_value = null;}else{c_start = c_value.indexOf("=", c_start) + 1;var c_end = c_value.indexOf(";", c_start);if (c_end == -1){c_end = c_value.length;}c_value = unescape(c_value.substring(c_start,c_end));}return c_value;}

					checkSession();

					function checkSession(){
					var c = getCookie("login");
					if (c === "yes") {
					

					} else {
				
						
						websocket_server.onopen = function(e) {
							$('#widget-right').load('chat/widget-right.php');
							$('#chat_output').load('chat/ce.php');
							var user_name = $('#user_name').val();
							websocket_server.send(
								JSON.stringify({
									'type': 'chat',
									'user_id': 1,
									'user_name': 'admin',
									'chat_msg': user_name + ' has joined chat'
								})
							);
							
							$.ajax({
								type: "POST",
								url: "chat/bot_send.php",
								data: {
									msg: user_name + ' has joined chat',
									id: 1,
								},
								success: function() {
									autoScrolling_msg();
								}
							});
						};
										
					}
					setCookie("login", "yes", 1); // expire in 1 year; or use null to never expire
					}


	});



