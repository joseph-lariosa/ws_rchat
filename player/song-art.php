<?php include('player.inc.php');?>
<img class="card mr-2" data-toggle="modal" data-target="#art" width="50px" height="50px" src="<?php echo $nowPlaying->getCurrentSong()->getSong()->getArt();?>">


<!-- Modal -->
<div class="modal fade" id="art" tabindex="-1" role="dialog" aria-labelledby="art" aria-hidden="true">
  <div class="modal-dialog modal-lg bg-dark" role="document">
    <div class="modal-content bg-dark">

      <div class="modal-body">
      <img class="card mr-2 w-100" data-toggle="modal" data-target="#art" src="<?php echo $nowPlaying->getCurrentSong()->getSong()->getArt();?>">
      </div>

    </div>
  </div>
</div>
