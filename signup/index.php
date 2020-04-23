<?php 
include('../template/header.php');
include('../config.php');
include('../includes/defaults.inc.php');
session_start();
?>
  <?php  
    if(isset($_SESSION["username"]))  
    { 
        header('location:'.$base_url.'/index.php');  
    } else  {  ?>


<div class="container" id="login-wrapper">

    
        <div class="mx-auto col-lg-4">
            <div class="card p-3 ">
                <?php 
                if (isset($_SESSION['message']) ){
                echo "<div class='alert alert-danger'>".$_SESSION['message']."</div>";
                unset ($_SESSION['message']);
                } 
                ?>
                <form method="POST" class="form" action="<?php echo $base_url;?>/includes/signup.php">
                    <div class="form-group">
                        <input class="form-control" placeholder="First Name" type="text" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Last Name" type="text" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="name@emailaddress" type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Username" type="text" name="username" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Passowrd" type="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Repeat Password" type="password" name="password2" required>
                    </div>
                    <div class="input-signup text-center">
                            <input class="btn-block btn btn-success mb-2" type="submit" name="registration" value="Create Account">
                            Already have an account? <a class="font-weight-bold" href="<?php echo $base_url;?>/login">Login here</a>

                        </div>
                
                </form>
            </div>
        </div>
    <?php }  ?>  

</div>
<?php include('template/footer.php');?>