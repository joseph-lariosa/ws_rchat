

function changeValue(o){
    document.getElementById('chat_input').value="@" + o.innerHTML + " ";
}


function autoScrolling() {
    $(".scroll_lock").animate({
        scrollTop: $(".scroll_lock")[0].scrollHeight
    }, 100);
}

function autoScrolling_msg() {
    $(".default_scroll").animate({
        scrollTop: $(".default_scroll")[0].scrollHeight
    }, 100);
}


document.addEventListener("DOMContentLoaded", function(event) {
    autoScrolling();
});

$('#chat_output').scroll(function() {
    var st = $(this).scrollTop(); 
    if( st > 500 ) {
    $("#chat_output").addClass("scroll_lock"); 
    } else {
    $("#chat_output").removeClass("scroll_lock"); 
    }
}); 



//Emoji Selector
window.addEventListener('DOMContentLoaded', () => {
    const button = document.querySelector('#emoji');
    const picker = new EmojiButton();
  
    picker.on('emoji', emoji => {
      document.querySelector('#chat_input').value += emoji;
      
    });
  
    button.addEventListener('click', () => {
      picker.togglePicker(button);
      picker.preventDefault();

    });
  });   
  



  	jQuery(function($) {

		// Websocket
		var websocket_server = new WebSocket("ws://rchat.test:8080/");

		websocket_server.onopen = function(e) {
			$('#widget-right').load('chat/widget-right.php');
			console.log("Connection established!");
            var user_name = $('#user_name').val();
            var user_id = $('#user_id').val();
			websocket_server.send(
				JSON.stringify({
					'type': 'socket',
					'user_id': user_id,
					'user_name': user_name
				})
			);
			$('#chat_output').load('chat/ce.php');

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
	});