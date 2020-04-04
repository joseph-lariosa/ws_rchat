<?php session_start();?>
    
    <div class="mx-auto">
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
            ?>
            <form method="POST" action="includes/login.php" class="form">
            <div class="form-group">
            <input class="form-control" placeholder="Username" type="text" name="username">
            </div>
            <div class="form-group">
            <input class="form-control" placeholder="password" type="password" name="password">
            </div>
            <div class="d-flex justify-content-center">
                <div class="input-login">
                    <input class="btn btn-primary" type="submit" name="login" value="Login">
                </div>
                <div class="signup-now">
                    &nbsp;or&nbsp;<a href="signup.php" class="btn btn-success">Create an Account</a>
                </div>
                </div>
            </form>
        </div>
    </div>

