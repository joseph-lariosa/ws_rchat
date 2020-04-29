<?php include('../config.php'); session_start();?>
<?php $query = mysqli_query($conn, "SELECT * FROM chat LEFT JOIN `users` ON users.userid=chat.userid WHERE chat_room_id='1' ORDER BY chatid DESC LIMIT 40 ") or die(mysqli_error());
			while ($row = mysqli_fetch_array($query)) {
				$chatID = $row['chatid'];
			?>


				<div class="chat-entry card p-1 m-1">
					<div class="row">
						<div class="col-md-12">
							<div class="text-muted float-right d-flex">
								<div class="time-stamp-h">
									<i class="fa fa-clock-o" title="<?php echo date("l,h:m A", strtotime($row['chat_date'])); ?>"></i>									
								</div>
								<?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true ) { ?>
											<div class="admin-chat-controls ml-2 d-flex">
												<form class="mr-2">
													<input name="del_chatid" id="chatid" type="hidden" value="<?php echo $chatID;?>">
													<button type="submit" class="mr-0 btn badge badge-warning" id="delete_chat" >X</button>
												</form>
											</div>
										<?php }?>
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
									<a href="#" class="text-white font-weight-bold text-capitalize" id="us" onclick="changeValue(this)"><?php echo $row['username']; ?></a><br><?php echo $row['chat_msg']; ?>
								</div>
							</div>
						</div>
					</div>
				</div>


			<?php } ?>