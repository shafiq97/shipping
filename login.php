<?php include("config.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['login'])) {
    // username and password sent from form 
    $myusername = mysqli_real_escape_string($conn, $_POST['username']);
    $mypassword = mysqli_real_escape_string($conn, $_POST['password']);
    $user_level = mysqli_real_escape_string($conn, $_POST['userLevel']);
    $result = mysqli_query($conn, "SELECT * FROM `user` WHERE `username`='$myusername' AND `password`='$mypassword' AND `status`='Active' AND `level`='$user_level'");
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $myusername = $row['username'];
        $userLevel = $row['level'];
        session_start();
        $_SESSION['login_user'] = $myusername;
        $_SESSION['login_user_level'] = $userLevel;
        if ($userLevel == 'admin') {
          header("location:admin/dashboard.php");
        } else {
          header("location:user/dashboard.php");
        }
      }
    } else {
      echo '<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Your Login Name or Password is invalid.
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
            <h3 class="panel-title">Login</h3>
          </div>
          <div class="panel-body">
            <form method="POST" action="login.php">
              <div class="col-md-12 col-sm-12">
                <div class="form-group col-md-8">
                  <label class="labelstaff">Username:</label>
                  <input name="username" class="form-control input-sm" id="username">
                </div>
                <div class="form-group col-md-8">
                  <label for="Password" class="labelstaff">Password:</label>
                  <input type="password" class="form-control input-sm" name="password">
                </div>
                <div class="form-group col-md-8">
                  <label for="mobile" class="labelstaff">Login as:</label>
                  <select class="form-control" id="userLevel" name="userLevel" type="text">
                    <option value="admin">Admin</option>
                    <option value="customer">Customer</option>
                  </select>
                </div>
                <div class="form-group col-md-8">
                  <p>Don't have an account? <a href="registration.php">Register here</a></p>
                </div>
                <div class="col-md-12">
                  <div class="form-group col-md-1 col-sm-3">
                    <input type="submit" name="login" class="btn btn-outline-primary" value="Login" />
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-3"></div>
    </div>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>