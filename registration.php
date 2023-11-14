<?php include("config.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Registration</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>


  <!-- JavaScript function to compare passwords -->
  <script>
    function check() {
      var pass1 = document.getElementById("pass1").value;
      var pass2 = document.getElementById("pass2").value;
      var det = document.getElementById("passwordDetails");

      if (pass1 != pass2) {
        det.innerHTML = "<b style='color:red;'>Password Mismatch...</b>";
      } else {
        det.innerHTML = "<b style='color:green;'>Passwords match</b>";
      }
    }
  </script>

  <?php
  if (isset($_GET['success'])) {
    echo '<div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Success! You have registered successfully. <a href="login.php">Login now?</a>
          </div>';
  }
  if (isset($_POST['registration'])) {
    $username = $_POST['username'];
    $mobile = $_POST['mobile'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if ($pass1 == $pass2) {
      $similarityResult = mysqli_query($conn, "select * from `user` where `username`='$username'");
      if ($similarityResult->num_rows > 0) {
        echo '<div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <b>That username is already registered.</b>
                  </div>';
      } else {
        $result = mysqli_query($conn, "insert into `user` (username, password, mobile) values('$username', '$pass1', '$mobile')");
        if ($result) {
          echo '<script> window.location="registration.php?success=True" </script>';
        } else {
          echo '<div class="alert alert-danger alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          Sorry! Something went wrong. Please try again.
                      </div>';
        }
      }
    } else {
      echo '<div class="alert alert-warning alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  Your passwords do not match.
              </div>';
    }
  }
  ?>

  <div class="container">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="panel panel-default" style="margin:40px;">
          <div class="panel-heading">
            <h3 class="panel-title">Customer Registration</h3>
          </div>
          <div class="panel-body">
            <form method="POST" action="registration.php">
              <div class="col-md-12 col-sm-12">
                <div class="form-group col-md-8">
                  <label class="labelstaff">Username:</label>
                  <input type="username" class="form-control input-sm" name="username" required />
                </div>
                <div class="form-group col-md-8">
                  <label for="mobile" class="labelstaff">Mobile No:</label>
                  <input type="text" class="form-control input-sm" name="mobile" required />
                </div>
                <div class="form-group col-md-8">
                  <label for="pass1" class="labelstaff">Password:</label>
                  <input type="password" class="form-control input-sm" id="pass1" name="pass1" required />
                </div>
                <div class="form-group col-md-8">
                  <label for="pass2" class="labelstaff">Confirm Password:</label>
                  <input type="password" class="form-control input-sm" id="pass2" name="pass2" required />
                </div>
                <div class="form-group col-md-8">
                  <div id="passwordDetails"></div>
                </div>
                <div class="col-md-12">
                  <div class="form-group col-md-1 col-sm-3">
                    <input type="submit" class="btn btn-outline-primary" name="registration" value="Register" />
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>

  <footer>
    <div class="container">

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="bootstrap/js/bootstrap.min.js"></script>
    </div>
  </footer>
</body>

</html>