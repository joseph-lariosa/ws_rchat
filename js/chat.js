
jQuery(function ($) {

	$(document).ready(function(){
		$(document).bind("contextmenu",function(e){
		   return false;
		});
	 });


	

	// Websocket

	var websocket_server = new WebSocket("ws://localhost:8080/");

	websocket_server.onopen = function (e) {
		$('#widget-right').load('chat/widget-right.php');
		$('#chat_output').load('chat/ce.php');
		$('#song_details').load('player/song-detail.php');
		$('#song_art').load('player/song-art.php');


		autoScrolling();
	};

	websocket_server.onclose = function (e) {

	};

	websocket_server.onerror = function (e) {
		// Errorhandling
	}

	$('#send_msg').on('click', function () {
		if ($('#chat_input').val() == "") {
			alert('Please write message first');
			event.preventDefault();

		} else {
			event.preventDefault();
			var chat_msg = $('#chat_input').val();
			//var StrippedString = chat_msg.replace(/\<(?!img|br).*?\>/g, "");
			var StrippedString = chat_msg.replace(/(<([^>]+)>)/ig,"");

			var res = StrippedString.substr(0, 255);
			//end chat_input
			var room_id = $('#room_id').val();
			var user_name = $('#user_name').val();
			var user_id = $('#user_id').val();
			var chat_img = $('#chat_img').val();
			var fewSeconds = 1.5;
			var submit_button = document.getElementById("chat_input");

			if(chat_img != ''){
				var res = "<img class='d-block card' src='uploads/chat/"+chat_img+"' width='400px'>"+StrippedString;
			}
			

			websocket_server.send(
				JSON.stringify({
					'type': 'chat',
					'user_id': user_id,
					'user_name': user_name,
					// 'chat_img': chat_img,
					'chat_msg': res
				})
			);

			
			
			$.ajax({
				type: "POST",
				url: "chat/send_message.php",
				data: {
					msg: res,
					chat_img,
					id: room_id
				},
				success: function () {
					autoScrolling_msg();
				},
			});

	

			
			$("input[type='text']").val('');
			document.getElementById('file-upload').innerHTML = '<i class="fa fa-image"></i>';
			document.getElementById("chat_img").value= '';

			// Reload Song Details
			$('#song_details').load('player/song-detail.php');
			$('#song_art').load('player/song-art.php');


			// $(submit_button).addClass("disabled");

			// var btn = $(this);
			// btn.prop('disabled', true);
			// setTimeout(function(){
			// 	btn.prop('disabled', false);
			// 	//$(submit_button).removeClass("disabled");
			// }, fewSeconds*1000);
		}
	});



	websocket_server.onmessage = function (e) {
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


	
	  


	$('.disabled').on('click', function () {
		alert('Please do not spam');
	});



	function setCookie(c_name, value, exdays) { var exdate = new Date(); exdate.setDate(exdate.getDate() + exdays); var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString()); document.cookie = c_name + "=" + c_value; }
	function getCookie(c_name) { var c_value = document.cookie; var c_start = c_value.indexOf(" " + c_name + "="); if (c_start == -1) { c_start = c_value.indexOf(c_name + "="); } if (c_start == -1) { c_value = null; } else { c_start = c_value.indexOf("=", c_start) + 1; var c_end = c_value.indexOf(";", c_start); if (c_end == -1) { c_end = c_value.length; } c_value = unescape(c_value.substring(c_start, c_end)); } return c_value; }

	checkSession();

	function checkSession() {
		var c = getCookie("login");
		if (c === "yes") {


		} else {


			websocket_server.onopen = function (e) {
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
					success: function () {
						autoScrolling_msg();
					}
				});
			};

		}
		setCookie("login", "yes", 1); // expire in 1 year; or use null to never expire
	}

	$('#logout-link').on('click', function () {

			
		function setCookie(c_name,value,exdays){var exdate=new Date();exdate.setDate(exdate.getDate() + exdays);var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());document.cookie=c_name + "=" + c_value;}
		function getCookie(c_name){var c_value = document.cookie;var c_start = c_value.indexOf(" " + c_name + "=");if (c_start == -1){c_start = c_value.indexOf(c_name + "=");}if (c_start == -1){c_value = null;}else{c_start = c_value.indexOf("=", c_start) + 1;var c_end = c_value.indexOf(";", c_start);if (c_end == -1){c_end = c_value.length;}c_value = unescape(c_value.substring(c_start,c_end));}return c_value;}

		checkSession();

		function checkSession(){
		var c = getCookie("login");
		if (c === "yes") {
			setCookie("login", "no", 1);
		}
	}

	});




});



