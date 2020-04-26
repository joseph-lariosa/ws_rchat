<?php include('player.inc.php');?>
<span class="badge badge-info col-lg-2">Title:</span> <span class=""><?php echo $nowPlaying->getCurrentSong()->getSong()->getTitle();?></span><br>
<span class="badge badge-primary col-lg-2">Artist:</span> <span class=""><?php echo $nowPlaying->getCurrentSong()->getSong()->getArtist();?></span>