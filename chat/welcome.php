<script>
	jQuery(function($) {
		// Websocket
		var websocket_server = new WebSocket("ws://rchat.test:8080/");


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
    		var user_name = $('#user_name').val();
						websocket_server.send(
							JSON.stringify({
								'type': 'chat',
								'user_id': 1,
								'user_name': 'admin',
								'chat_msg': user_name + ' has joined chat'
							})
						);

						});
						</script>