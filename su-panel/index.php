<?php
include('../includes/config.inc.php');
include('../includes/db.php');

$db = new db($dbhost, $dbuser, $dbpass, $dbname);


session_start();
$cu = $_SESSION['userName']; $isAdmin = $_SESSION['isAdmin'];
if ($isAdmin != TRUE) {
  header("Location: ../index.php");
}

?>

<!doctype html>
<html lang="en">

<head>
  <title>Live Chat Room</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/admin.css" crossorigin="anonymous">
  <script src="../js/jquery.js"></script>
</head>

<body>

  <body>
    <div class="page-wrapper chiller-theme toggled">
      <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fas fa-bars"></i>
      </a>
      <nav id="sidebar" class="sidebar-wrapper">
        <div class="sidebar-content">
          <div class="sidebar-brand">
            <a href="#">SU Panel</a>

          </div>
          <div class="sidebar-header">

            <div class="text-white">
              Hello, <span class="user-name text-capitalize"><?php echo $cu; ?>
              </span>
            </div>
          </div>

          <div class="sidebar-menu">
            <ul>
              <li class="header-menu">
                <span>General</span>
              </li>
              <li>
                <a href="users.php" id="users" class="load">
                  <i class="fa fa-user"></i>
                  <span>Users</span>
                </a>
              </li>
              <li>
                <a href="chat-settings.php" class="load">
                  <i class="fa fa-cog"></i>
                  <span>Chat Settings</span>
                </a>
              </li>
              <li>
                <a href="radio-settings.php" class="load">
                  <i class="fa fa-headphones"></i>
                  <span>Radio Settings</span>
                </a>
              </li>



            </ul>
          </div>
        </div>
        <div class="sidebar-footer">

        </div>
      </nav>
      <main class="page-content">
        <div class="container-fluid">

          <div id="admin-content"></div>

        </div>

      </main>
    </div>









    <script>
      jQuery(function($) {

        $(function() {
          $("a.load").click(function(e) {
            e.preventDefault();
            $("#admin-content").load($(this).attr("href"));
          });
        });

        $(document).ready(function() {
          $("#admin-content").load('users.php');
        });


        $(".sidebar-dropdown > a").click(function() {
          $(".sidebar-submenu").slideUp(200);
          if (
            $(this)
            .parent()
            .hasClass("active")
          ) {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
              .parent()
              .removeClass("active");
          } else {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
              .next(".sidebar-submenu")
              .slideDown(200);
            $(this)
              .parent()
              .addClass("active");
          }
        });

        $("#close-sidebar").click(function() {
          $(".page-wrapper").removeClass("toggled");
        });
        $("#show-sidebar").click(function() {
          $(".page-wrapper").addClass("toggled");
        });




      });


      $(document).ready(function() {

        load_data();

        function load_data(query) {
          $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {
              query: query
            },
            success: function(data) {
              $('#result').html(data);
            }
          });
        }
        $('#search_text').keyup(function() {
          var search = $(this).val();
          if (search != '') {
            load_data(search);
          } else {
            load_data();
          }
        });
      });
    </script>


    <!-- <script src="../js/app.js?<?php echo rand(); ?>"></script> -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="../js/theme.min.js"></script>
  </body>

</html>