<?php
include('../config.php');
//fetch.php
$output = '';
$modals = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM users
  WHERE username LIKE '%".$search."%'
  OR firstname LIKE '%".$search."%' 
  OR lastname LIKE '%".$search."%' 
  OR email LIKE '%".$search."%' 
  OR role LIKE '%".$search."%'
  OR ban_status LIKE '%".$search."%'
 ";
}
else
{
 $query = "
  SELECT * FROM users ORDER BY userid
 ";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>User ID</th>
     <th>Username</th>
     <th>First Name</th>
     <th>Last Name</th>
     <th>Email</th>
     <th>Role</th>
     <th>Ban Status</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {

    $banstatus = $row['ban_status'];
    $dbbanstatus = $row['ban_status'];
    $dbuserId = $row['userid'];
    $dbemail = $row['email'];
    $dbusername = $row['username'];
    $dbuserfn = $row['firstname'];
    $dbuserln = $row['lastname'];
    $dbuser_photo = $row['img_url'];
    $dbUserStatus = $row['login_status'];
    $dbrole = $row['role'];
    $dbroleform = $row['role'];
    $dbLevel = $row['user_level'];
    $dbUserbio = $row['bio'];
    $dbUserfb = $row['fb'];
    $dbUsertw = $row['tw'];
    $dbUserig = $row['ig'];

    if($banstatus != 1){
        $banstatus = "<span class='text-success'>Active</span>";
      } else {
        $banstatus = "<span class='text-danger'>Banned</span>";
    }

    if($dbrole === "ADMIN"){
        $dbrole = "<span class='badge badge-info'>".$dbrole."</span>";
    }elseif($dbrole === "VIP"){
        $dbrole = "<span class='badge badge-danger'>".$dbrole."</span>";
    } else {
        $dbrole = "<span class='badge badge-secondary'>".$dbrole."</span>";
    }

    
    if ($dbuser_photo != '') {
        $userphoto = "../uploads/" . $dbuser_photo . "";
      } else {
        $userphoto = "../images/default-person.png";
    }

  $output .= '
   <tr>
    <td>'.$row["userid"].'</td>
    <td> <img width="30px" src="'.$userphoto.'" class="mr-1">'.$row["username"].'</td>
    <td>'.$row["firstname"].'</td>
    <td>'.$row["lastname"].'</td>
    <td>'.$row["email"].'</td>
    <td>'.$dbrole.'</td>
    <td>'.$banstatus.'</td>
    <td><a href="#" data-toggle="modal" data-target="#'.$dbusername.'">Edit <i class="fa fa-cogs" aria-hidden="true"></i></a></td>
   </tr>

 
  ';

  $modals .= '  <div class="modal fade" id="'.$dbusername.'" tabindex="-1" role="dialog" aria-labelledby="update_profile" aria-hidden="true">
  <div class="modal-dialog modal-lg text-white" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="update_profile">Update Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <h6>Update Information</h6>
        <form method="post" class="mb-2" action="fetch-user-update.php">
          <div class="form-group d-flex align-items-end">
            <input type="hidden" name="cu" value="'.$dbusername.'"> 
            <input type="text" name="firstname" id="firstname-'.$dbuserId.'" class="form-control mr-1" placeholder="'.$dbuserfn.'">
            <input type="text" name="lastname" id="lastname-'.$dbuserId.'" class="form-control ml-1" placeholder="'.$dbuserln.'">
          </div>
          <div class="form-group d-flex align-items-end">
          <input type="text" name="email" id="lastname-'.$dbemail.'" class="form-control" placeholder="'.$dbemail.'">
        </div>
        
          <div class="form-group">
          <label class="font-weight-strong"><span class="badge badge-warning">Ban Status:</span></label>
          <input type="text" name="role" id="role-'.$dbbanstatus.'" class="form-control" placeholder="'.$dbbanstatus.'">
          <label class="font-weight-strong"><span class="badge badge-info">Role:</span></label>
          <input type="text" name="role" id="role-'.$dbuserId.'" class="form-control" placeholder="'.$dbroleform.'">

        </div>
        
          
          <button class="btn btn-primary" type="submit" name="user_meta_su">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>';


 }

 echo $modals;

 echo $output;


}
else
{
 echo 'Data Not Found';
}

?>