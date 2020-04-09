<?php
set_time_limit(0);

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
require_once 'vendor/autoload.php';
require 'config.php';


class Chat implements MessageComponentInterface {
	protected $clients;
	protected $users;

	public function __construct() {
		$this->clients = new \SplObjectStorage;
	}

	public function onOpen(ConnectionInterface $conn) {
		$this->clients->attach($conn);
		// $this->users[$conn->resourceId] = $conn;
	}

	public function onClose(ConnectionInterface $conn) {
		$this->clients->detach($conn);
		// unset($this->users[$conn->resourceId]);
	}

	public function onMessage(ConnectionInterface $from,  $data) {

		global $conn;

		
		$from_id = $from->resourceId;
		$data = json_decode($data);
		$type = $data->type;
		$user_id = $data->user_id;

		$userData = mysqli_query($conn, "SELECT * FROM users WHERE userid=$user_id") or die(mysqli_error());
		$getUserdata = mysqli_fetch_array($userData);
		

		switch ($type) {
			case 'chat':
				$user_id = $getUserdata['userid'];
				$userName = $getUserdata['username'];
				$role = $getUserdata['role'];
				//$onlineStatus = $getUserdata['online_status'];
				//$banStatus = $getUserdata['ban_status'];
				//$by = $getUserdata['action_by];
				$chat_msg = $data->chat_msg;
				$response_from =

					"<div class='chat-entry card p-1 m-1 bg-primary'>
					<div class='row'>
						<div class='col-md-12'>
							<div class='d-flex'>

								<div class='c-left mr-2'>
									<img src='http://placehold.it/55x55'><br>
									<span class='mt-1 d-block badge badge-". $role . "'>" . $role . "</span>
								</div>
				
								<div class='c-right'>
									<a href='#' class='text-white font-weight-bold'  id='us' onclick='changeValue(this)'>" . $userName . "</a><br>" . $chat_msg . "
								</div>
							</div>
						</div>
					</div>	
				</div>";



				$response_to =

				"<div class='chat-entry card p-1 m-1'>
					<div class='row'>
						<div class='col-md-12'>
							<div class='d-flex'>
								<div class='c-left mr-2'>
									<img src='http://placehold.it/55x55'><br>
									<span class='mt-1 d-block badge badge-". $role . "'>" . $role . "</span>
								</div>
						
								<div class='c-right'>
									<a href='#' class='text-white font-weight-bold'  id='us' onclick='changeValue(this)'>".$userName."</a><br>".$chat_msg."
								</div>
							</div>
						</div>
					</div>	
				</div>";

				// Output
				$from->send(json_encode(array("type"=>$type,"msg"=>$response_from)));
				foreach($this->clients as $client)
				{
					if($from!=$client)
					{
						$client->send(json_encode(array("type"=>$type,"msg"=>$response_to)));
					}
				}
				break;
		}
	}

	public function onError(ConnectionInterface $conn, \Exception $e) {
		$conn->close();
	}
}
$server = IoServer::factory(
	new HttpServer(new WsServer(new Chat())),
	8080
);
$server->run();
?>