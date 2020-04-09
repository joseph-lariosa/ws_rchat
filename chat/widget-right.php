<?php include('../config.php'); session_start();?>
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
											<img src="<?php if ($row['img_url'] != '') {
															echo "uploads/" . $row['img_url'] . "";
														} else {
															echo "images/default-person.png";
														} ?>">
										</div>
									</div>
									<div class="user-details">
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
                    <h5 class="modal-title bg-dark text-white" id="<?php echo $row["username"]; ?>"><?php echo $row["firstname"] . " " . $row["lastname"]; ?></h5>
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
                        <?php $userName = $row['username'];  ?>
                        <h3><?php echo $row["firstname"] . " " . $row["lastname"] . "<br>"; ?></h3>
                        <?php $uRole = $row['role']; ?>
                        <?php echo "<div class='badge badge-" . $uRole . "'>" . $uRole . "</div>"; ?>
                        <?php echo "<span class='badge badge-level'>Lvl " . $row['user_level'] . "</span> "; ?>
                        <?php  echo "Current Exp:".$row['chat_point']." Exp to Next Level: ".$row['max_exp']."";  ?>
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
                            <input name="ban_user_name" id="ban_user_name" type="hidden" value="<?php echo $userName; ?>">
                            <button type="submit" class="mr-0 btn badge badge-danger" id="ban_user">Ban</button>
                            </form>
                            <form>
                            <input name="kick_user" id="kick_user" type="hidden" value="<?php echo $userID; ?>">
                            <input name="kick_user_name" id="kick_user_name" type="hidden" value="<?php echo $userName; ?>">
                            <button type="submit" class="mr-0 btn badge badge-warning" id="kick_user">Kick</button>
                            </form>
                        </div>
                    </div>
                    <?php } ?>
                  </div>

                </div>
              </div>
            </div>

         <?php }}?>