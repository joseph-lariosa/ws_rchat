<?php 
include('../template/header.php');
session_start();
?>
  <?php  

    if(isset($_SESSION["username"]))  
    { 
        header('location:index.php');  
    } else  {  ?>


<div class="container" id="login-wrapper">

    
        <div class="mx-auto col-lg-4">
            <div class="card p-3">
             

                    <?php
                     $selector = $_GET["selector"];
                     $validator = $_GET["validator"];

                     if (empty($selector) || empty($validator)){
                         header("Location: ../forgot-password");
                         $_SESSION['message'] = "Invalid Request! Please request a password reset email.";
                     } else { ?>
                      
                        <?php 
                        if (isset($_SESSION['message']) ){
                        echo "<div class='alert alert-danger'>".$_SESSION['message']."</div>";
                        unset ($_SESSION['message']);
                        } 
                        ?>

                        <form method="POST" class="form" action="../includes/reset-password.inc.php">

                            <input type="hidden" name="selector" id="selector" value="<?php echo $selector ?>">
                            <input type="hidden" name="validator" id="validator" value="<?php echo utf8_decode($validator) ?>">

                            <input class="form-control" placeholder="Enter New Password" type="password" name="password" id="password" required>
                            <input class="form-control" placeholder="Repeat New Password" type="password" name="password2" id="password2" required>

                            <div class="form-group pb-0 mb-0">
                                <div class="input-signup text-center">
                                    <input class="btn-block btn btn-success mt-2 mb-2" type="submit" name="reset-password-submit" value="Reset Passsword">
                                    Already have an account? <a class="font-weight-bold" href="../login">Login here</a>

                                </div>
                            </div>
                        
                        </form>
<?php
                     }

                    ?>
                  
                    
            </div>
        </div>
    <?php }  ?>  

</div>
<?php include('../template/footer.php');?>