<?php
include('../config.php');
include('../class/user.php');

$cu = $_SESSION['userName'];
$isAdmin = $_SESSION['isAdmin'];


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
  <!-- Optional JavaScript -->


  <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Admin Panel</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu" aria-labelledby="dropdownId">
            <a class="dropdown-item" href="#">Action 1</a>
            <a class="dropdown-item" href="#">Action 2</a>
          </div>
        </li>
      </ul>

    </div>
  </nav>



  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">
                <span data-feather="home"></span>
                Dashboard <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file"></span>
                Users
              </a>
            </li>

          </ul>
        </div>
      </nav>

      <main role="main " class="col-md-9 ml-sm-auto col-lg-10 px-4 pt-3">




        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon btn btn-info">Search</span>
            <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
          </div>
        </div>

        <div id="result"></div>




        <script>
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