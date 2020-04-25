<?php include('../config.php');?>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="cf-tab" data-toggle="pill" href="#cf" role="tab" aria-controls="cf" aria-selected="true">Chat Feed</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
  </li>
</ul>

<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="cf" role="tabpanel" aria-labelledby="cf-tab">
      <a href="#" onclick="myAjax()" class="btn btn-danger">Truncate Chat</a>
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

  </div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

  </div>
</div>


<script>
    function myAjax() {
      $.ajax({
           type: "POST",
           url: './db-commands/delete_all_chat.php',
           data:{action:'call_this'},
           success:function(data) {
             alert(data);
           }

      });
 }
</script>