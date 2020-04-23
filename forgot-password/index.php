<?php 
include('../template/header.php');
include('../config.php');
session_start();
?>
  <?php  
    if(isset($_SESSION["username"]))  
    { 
        header('location:index.php');  
    } else  {  ?>


<div class="container" id="login-wrapper">

    
        <div class="mx-auto col-lg-4">
            <div class="card p-3 ">
                <?php 
                if (isset($_SESSION['message-success']) ){
                echo "<div class='alert alert-success'>".$_SESSION['message-success']."</div>";
                unset ($_SESSION['message-success']);
                } else {
                    echo  "<p>An email will be sent to your email address containing the password reset link.</p>";
                }


                if (isset($_SESSION['message']) ){
                    echo "<div class='alert alert-danger'>".$_SESSION['message']."</div>";
                    unset ($_SESSION['message']);
                    }
                ?>
                <form method="POST" class="form" action="../includes/reset_request.inc.php">

                   
                    <div class="form-group">
                        <input class="form-control" placeholder="name@emailaddress" type="email" name="email" required>
                    </div>
                   
                    <div class="input-signup text-center">
                            <input class="btn-block btn btn-success mb-2" type="submit" name="reset-request-submit" value="Reset Passsword">
                           Go back to login <a class="font-weight-bold" href="../login">click here</a>

                        </div>
                
                </form>
            </div>
        </div>
    <?php }  ?>  

</div>
<?php include('../template/footer.php');?>