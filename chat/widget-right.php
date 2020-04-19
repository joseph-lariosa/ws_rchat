<?php include('../config.php'); session_start();?>


<div class="sidebar-widget ml-2 mr-2 mb-2">
    <div class="widget-header card bg-dark p-2 pt-0 mb-2">
      <h6 class="text-white mb-0">My Profile</h6>
    </div>

    <?php 
    $query = ("SELECT * FROM users WHERE username='{$_SESSION['userName']}'");
    $select_user_query = mysqli_query($conn, $query);

    if (!$select_user_query) {
      die("QUERY FAILED" . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_array($select_user_query)) {
      $dbuserId = $row['userid'];
      $dbusername = $row['username'];
      $dbuserfn = $row['firstname'];
      $dbuserln = $row['lastname'];
      $dbuser_photo = $row['img_url'];
      $dbUserStatus = $row['login_status'];
      $dbUserBanStatus = $row['ban_status'];
      $dbrole = $row['role'];
      $dbLevel = $row['user_level'];
      $dbUserbio = $row['bio'];
      $dbUserfb = $row['fb'];
      $dbUsertw = $row['tw'];
      $dbUserig = $row['ig'];
    }
    ?>

    <?php if ($dbusername == $_SESSION['userName']) { ?>

      <div class="card bg-dark pb-2">
        <div class="d-flex">
          <div class="pl-2 pt-2">
            <div class="dp-wrapper">
              <img src="<?php if ($dbuser_photo != '') {
                          echo "uploads/" . $dbuser_photo . "";
                        } else {
                          echo "images/default-person.png";
                        } ?>">
            </div>

          </div>
          <div class="user-details text-white pl-2 pb-2 pt-1">
            <ul class="list-unstyled">
              <li class="list-unstyled-item text-capitalize">
                <a href="#" data-toggle="modal" data-target="#<?php echo $dbusername ?>"><?php echo $dbuserfn . " " . $dbuserln; ?></a>
              </li>
              <li class="list-unstyled-item">
                <span class="badge badge-<?php echo $dbrole; ?>">
                  <?php echo $dbrole; ?> <span class="badge badge-warning">
                    Level: <?php echo $dbLevel; ?>
                  </span>
                </span>
              </li>
            </ul>

          </div>
        </div>
        <div class="update-toggle">
          <ul class="list-unstyled">
            <li class="list-unstyled-item">
              <a href="#update-profile" class="mr-0 text-muted" data-toggle="modal" data-target="#update_profile"><i class="fa fa-gear"></i> Update</a>
            </li>
          </ul>
        </div>

      </div>


      <!-- Modal -->
      <div class="modal fade" id="update_profile" tabindex="-1" role="dialog" aria-labelledby="update_profile" aria-hidden="true">
        <div class="modal-dialog modal-lg text-white" role="document">
          <div class="modal-content bg-dark">
            <div class="modal-header">
              <h5 class="modal-title" id="update_profile">Update Profile</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <h6>Update photo</h6>
              <form method="post" action="profiles/upload.php" enctype="multipart/form-data">
                <div class="custom-file mb-2">
                  <input type="file" name="file" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
                <button class="btn btn-primary" type="submit" name="but_upload">Upload</button>
                <script>
                  $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                  });
                </script>
              </form>

              <hr class="bg-white">

              <h6>Update Information</h6>
              <form method="post" action="profiles/update_info.php">
                <div class="form-group">
                  <input type="text" name="firstname" id="firstname" class="form-control mb-2" placeholder="<?php echo $dbuserfn; ?>">
                  <input type="text" name="lastname" id="lastname" class="form-control mb-2" placeholder="<?php echo $dbuserln; ?>">
                </div>
          


                <div class="form-group">
                  <label class="label">Bio</label>
                  <textarea type="text" name="bio" id="bio" class="form-control mb-2" <?php if ($dbUserbio == ''){ echo "placeholder='Say something about your self.'"; }?>><?php { echo $dbUserbio; }?></textarea>
                  <label class="label">Social Accounts</label>
                  <input type="text" name="fb" id="fb" class="form-control mb-2" <?php if ($dbUserfb == ''){ echo "placeholder='https://facebook.com/username'"; } else { echo "value='$dbUserfb'"; } ?>>
                  <input type="text" name="tw" id="tw" class="form-control mb-2" <?php if ($dbUsertw == ''){ echo "placeholder='https://twitter.com/username'"; } else { echo "value='$dbUsertw'"; } ?>>
                  <input type="text" name="ig" id="ig" class="form-control mb-2" <?php if ($dbUserig == ''){ echo "placeholder='https://instagram.com/username'"; } else { echo "value='$dbUserig'"; } ?>>
                </div>
                <button class="btn btn-primary" type="submit" name="user_meta">Update</button>
              </form>

            </div>


          </div>
        </div>
      </div>

    <?php } ?>
    </div>

    <!--//End Profile Card-->



<div class="sidebar-widget ml-2 mr-2 mb-2">
			<div class="widget-header card bg-dark p-2 pt-0 mb-2">
				<h6 class="text-white mb-0">Online Users</h6>
			</div>

			<div class="user-list">
				<ul class="list-unstyled">
					<?php $query = ("SELECT * FROM users WHERE login_status=1");
					$online_users = mysqli_query($conn, $query);
					if ($online_users->num_rows > 0) {
						while ($row = $online_users->fetch_assoc()) { ?>
							<li class="list-unstyled-item mb-1">
								<div class="d-flex">
									<div class="user-dp mr-2">
										<div class="dp-wrapper">
											<img  data-toggle="modal" data-target="#<?php echo $row["username"]; ?>" src="<?php if ($row['img_url'] != '') {
															echo "uploads/" . $row['img_url'] . "";
														} else {
															echo "images/default-person.png";
														} ?>">
										</div>
									</div>
									<div class="user-details text-capitalize">
										<?php $userID = $row['userid'];  ?>
										<?php $userName = $row['username'];  ?>
										<a href="#" data-toggle="modal" data-target="#<?php echo $row["username"]; ?>"><?php echo $row["firstname"] . " " . $row["lastname"] . "<br>"; ?></a>
										<?php $uRole = $row['role']; ?>
										<?php echo "<div class='badge badge-" . $uRole . "'>" . $uRole . "</div>"; ?>
										<?php echo "<span class='badge badge-level'>Lvl " . $row['user_level'] . "</span>"; ?>

									</div>
								</div>
							</li>
					<?php }
					} ?>
				</ul>
			</div>
		</div>


		<?php $query = ("SELECT * FROM users WHERE login_status=1");
        $online_users = mysqli_query($conn, $query);
        if ($online_users->num_rows > 0) {
          while ($row = $online_users->fetch_assoc()) { ?>

            <div class="modal fade" id="<?php echo $row["username"]; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $row["username"]; ?>" aria-hidden="true">
              <div class="modal-dialog modal-lg bg-dark" role="document">
                <div class="modal-content bg-dark">
                  <div class="modal-header">
                    <h5 class="modal-title bg-dark text-white text-capitalize" id="<?php echo $row["username"]; ?>">Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body bg-dark text-white">

                    <div class="row">
                      <div class="col-md-4 user-dp">
                        <div class="dp-wrapper-modal">
                          <img class="rounded img-fluid" src="<?php if ($row['img_url'] != '') {
                                      echo "uploads/" . $row['img_url'] . "";
                                    } else {
                                      echo "images/default-person.png";
                                    } ?>">
                        </div>
                      </div>
                      <div class="col-md-8 user-details">
                        <?php $userID = $row['userid'];  ?>
                        <?php $dbusername = $row['username'];  ?>

                        <h3 class="text-capitalize"><?php echo $row["firstname"] . " " . $row["lastname"] . "<br>"; ?></h3>
                        <?php $uRole = $row['role']; ?>
                        <?php echo "<div class='badge badge-" . $uRole . "'>" . $uRole . "</div>"; ?>
                        <?php echo "<span class='badge badge-level'>Lvl " . $row['user_level'] . "</span> "; ?>
            


                        <div class="social-link mt-3">
                            <ul class="list-inline">
                              <?php if($row['fb'] != ''){ echo "<li class='list-inline-item'><a href='".$row['fb']."'><i class='fa fa-facebook fa-2x'></i></a></li>";}?>
                              <?php if($row['tw'] != ''){ echo "<li class='list-inline-item'><a href='".$row['tw']."'><i class='fa fa-twitter fa-2x'></i></a></li>";}?>
                              <?php if($row['ig'] != ''){ echo "<li class='list-inline-item'><a href='".$row['ig']."'><i class='fa fa-instagram fa-2x'></i></a></li>";}?>
                            </ul>
                          </div>
                        <hr class="bg-white">
                        <div class="social-info">
                          <div class="u-bio">
                              <h5>About me</h5>
                              <p><?php echo $row['bio'];?></p>
                          </div>
                          
                        </div>
                      </div>
                    </div>

                    <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) { ?>
                      <div class="widget-admin mt-2">
                        Admin Action
                        <div class="admin-chat-controls d-flex float-right">
                            <form class="mr-2">
                            <input name="ban_user" id="ban_user" type="hidden" value="<?php echo $userID; ?>">
                            <input name="ban_user_name" id="ban_user_name" type="hidden" value="<?php echo $dbusername; ?>">
                            <button type="submit" class="mr-0 btn badge badge-danger ban_button <?php echo $dbusername; ?>" id="ban_user">Ban</button>
                            </form>
                            <form>
                            <input name="kick_user" id="kick_user" type="hidden" value="<?php echo $userID; ?>">
                            <input name="kick_user_name" id="kick_user_name" type="hidden" value="<?php echo $dbusername; ?>">
                            <button type="submit" class="mr-0 btn badge badge-warning" id="kick_user">Kick</button>
                            </form>
                        </div>
                    </div>
                    <?php } ?>
                  </div>

                </div>
              </div>
            </div>

            <script>
          	jQuery(function($) {
                // Websocket

                var websocket_server = new WebSocket("ws://rchat.test:8080/");

                $('.ban_button.<?php echo $dbusername; ?>').on('click', function() {
                    var banned_user =  '<?php echo $dbusername?>';
                    var chat_msg = "<span class='badge badge-danger'>" + banned_user + "</span>" + " has been banned."
                    var room_id = "1"
                    var user_id = $('#user_id').val();

                    websocket_server.send(
                      JSON.stringify({
                        'type': 'chat',
                        'user_id': '1',
                        'chat_msg': chat_msg
                      })
                    );
                    $.ajax({
                      type: "POST",
                      url: "chat/bot_send.php",
                      data: {
                        msg: chat_msg,
                        id: room_id,
                      },
                      success: function() {
                        autoScrolling_msg();
                      }
                    });
                    $.ajax({
                      type: "POST",
                      url: "chat/actions/ban.php",
                      data: {
                        ban: "1",
                        user_to_ban: banned_user,
                      },
                      success: function() {
                        autoScrolling_msg();
                      }
                    });
                  });

                });
         </script>

         <?php }}?>


         