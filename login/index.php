<?php session_start();?>
<?php include('../template/header.php'); include('../includes/defaults.inc.php');

if (isset($_SESSION) && isset($_SESSION['userName'])) {
    header("Location: ../index.php");
} 

?>

<div class="container" id="login-wrapper">

    
<div class="mx-auto col-lg-4">
        <div class="card p-3">
            <?php 
            if (isset($_SESSION['message']) ){
            echo "<div class='alert alert-danger'>".$_SESSION['message']."</div>";
            unset ($_SESSION['message']);
            } 

            if(isset($_GET['reg_success']) == 1)
                {
                echo "<div class='alert alert-success'>Registration Successful! Please login here </div>";
                }

            if(isset($_GET['reset']) == "success")
            {
                echo "<div class='alert alert-success'>Password Upadated! Please login.</div>";
            }

    
            ?>
            <form method="POST" onSubmit="return validateForm();" action="<?php echo $base_url;?>/includes/login.php" class="form">
            <div class="form-group">
            <input class="form-control" placeholder="Username" type="text" name="username">
            </div>
            <div class="form-group">
            <input class="form-control" placeholder="password" type="password" name="password">
            </div>
                <div class="input-login w-100 text-center">
                    <input class="btn btn-primary w-100" type="submit" name="login" value="Login">
                    <div class="link-block mt-2">
                     Need an account? <a href="<?php echo $base_url;?>/signup" class="font-weight-bold">Register here.</a><br>Lost Password? <a href="<?php echo $base_url;?>/forgot-password" class="font-weight-bold">Click here.</a>
                    </div>
                
                </div>
            </form>
        </div>
    </div>

</div>




    <?php include('../template/footer.php');?>