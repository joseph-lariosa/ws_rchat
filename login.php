<?php session_start();?>
<?php include('template/header.php');?>

<script>
      	jQuery(function($) {

                     function setCookie(c_name,value,exdays){var exdate=new Date();exdate.setDate(exdate.getDate() + exdays);var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());document.cookie=c_name + "=" + c_value;}
					function getCookie(c_name){var c_value = document.cookie;var c_start = c_value.indexOf(" " + c_name + "=");if (c_start == -1){c_start = c_value.indexOf(c_name + "=");}if (c_start == -1){c_value = null;}else{c_start = c_value.indexOf("=", c_start) + 1;var c_end = c_value.indexOf(";", c_start);if (c_end == -1){c_end = c_value.length;}c_value = unescape(c_value.substring(c_start,c_end));}return c_value;}

					checkSession();

					function checkSession(){
					var c = getCookie("login");
					if (c === "yes") {
                        setCookie("login", "no", 1); // expire in 1 year; or use null to never expire
                    }
                }
          });
</script>


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
            ?>
            <form method="POST" onSubmit="return validateForm();" action="includes/login.php" class="form">
            <div class="form-group">
            <input class="form-control" placeholder="Username" type="text" name="username">
            </div>
            <div class="form-group">
            <input class="form-control" placeholder="password" type="password" name="password">
            </div>
                <div class="input-login w-100 text-center">
                    <input class="btn btn-primary w-100" type="submit" name="login" value="Login">
                    <div class="link-block mt-2">
                     Need an account? <a href="signup.php" class="font-weight-bold">Register here.</a>
                    </div>
                
                </div>
            </form>
        </div>
    </div>

</div>




    <?php include('template/footer.php');?>