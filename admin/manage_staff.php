<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Staff</title>
  <!-- Include necessary CSS and JavaScript libraries -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <?php
  include('session.php');
  include('config.php');
  ?>
  <?php include 'layouts/admin_header.php'; ?>
  <?php include 'layouts/admin_navigation.php'; ?>

  <header id="admin_header">
    <div class="container">
      <div class="row">
        <div class="col-md-10">
          <h1><i class="fa fa-cog fa-spin fa-fw"></i> Admin Dashboard</h1>
        </div>
        <div class="col-md-2">
          <div class="create">
            <h4><span class="" aria-hidden="true"></span> Welcome, <b><?php echo $login_session; ?></b></h4>
            <span></span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="row">
      <div class="col-md-offset-10 col-md-2">
        <button type="button" style="margin-top: 15px; margin-bottom: 10px;" class="btn btn-outline-primary" data-toggle="modal" data-target="#adduser"><i class="fas fa-user"></i> New Officers</button>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div id="adduser" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 400px;">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> New Officer</h4>
        </div>
        <div class="modal-body">

          <form id="adduser" action="manage_staff.php" method="POST" name="frmShipment">
            <input name="name" class="form-control" id="OfficeName" required="required" placeholder="fullName">
            <!-- Modify the branch dropdown to populate it dynamically from the database -->
            <select class="form-control" name="branch">
              <option>Select Branch</option>
              <?php
              // Fetch branch data from the database
              $branchQuery = "SELECT branch_city FROM branch_tbl";
              $branchResult = mysqli_query($conn, $branchQuery);

              if ($branchResult) {
                while ($branchRow = mysqli_fetch_assoc($branchResult)) {
                  $branchName = $branchRow['branch_city'];
                  echo '<option value="' . $branchName . '">' . $branchName . '</option>';
                }
              }
              ?>
            </select>

            <input name="address" class="form-control" id="PhoneNo" required="required" placeholder="address">
            <input name="phone" class="form-control" id="PhoneNo" required="required" placeholder="Phone">
            <input name="email" class="form-control" id="email" required="required" placeholder="Email">
            <select class="form-control" name="role">
              <option value="">--Role--</option>
              <option value="Agent">Agent</option>
              <option value="driver">Driver</option>
              <option value="support">Support</option>
              <option value="cleaner">Cleaner</option>
            </select>
            <input type="date" name="date_joined" class="form-control" id="datetimepicker" required="required" placeholder="Date joined">
            <input type="submit" class="form-control btn btn-primary" value="Proceed" name="add_staff_button">
          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- Modal end -->
  <?php
  if (isset($_GET['success'])) {
    echo '<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Success! new staff member has been added.
                </div>';
  }
  if (isset($_POST['add_staff_button'])) {
    $name = $_POST['name'];
    $branch = $_POST['branch'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $date_joined = $_POST['date_joined'];

    $result = mysqli_query($conn, "INSERT INTO `staff_tbl` (staff_name,staff_branch,staff_address,staff_no,staff_email,role,date_joined) 
         VALUES('$name','$branch','$address','$phone','$email','$role','$date_joined')");
    if ($result) {
      echo '<script> window.location="manage_staff.php?success=True" </script>';
    } else {
      echo '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Sorry! something went wrong. Please try again.
                </div>';
    }
  }
  ?>

  <div class="col-md-1"></div>
  <div class="col-md-10">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Manage Branches</h3>
      </div>
      <div class="panel-body">
        <table class="table table-striped table-hover" style="font-family: 'Segoe UI'; ">
          <thead>
            <tr>
              <th>Id</th>
              <th>Full Name</th>
              <th>Branch</th>
              <th>Address</th>
              <th>Email</th>
              <th>Phone No</th>
              <th>Role</th>
              <th>Date Joined</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $count = 1;
            $sel_query = "SELECT * FROM staff_tbl ORDER BY staff_id DESC; ";
            $result = mysqli_query($conn, $sel_query);
            while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td><?php echo $row["staff_id"]; ?></td>
                <td><?php echo $row["staff_name"]; ?></td>
                <td><?php echo $row["staff_branch"]; ?></td>
                <td><?php echo $row["staff_address"]; ?></td>
                <td><?php echo $row["staff_email"]; ?></td>
                <td><?php echo $row["staff_no"]; ?></td>
                <td><?php echo $row["role"]; ?></td>
                <td><?php echo $row["date_joined"]; ?></td>
                <td>
                  <button class="btn btn-warning delete-btn" data-id="<?php echo $row["staff_id"]; ?>">
                    <i class="fa fa-trash"></i> Delete
                  </button>
                </td>
              </tr>
            <?php $count++;
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-1"></div>

  <!-- Footer -->
  <?php include 'layouts/footer.php'; ?>
  <!--footer ends-->

  <!-- Bootstrap core JavaScript -->
  <script src="../bootstrap/js/jquery.datetimepicker.full.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $(".delete-btn").click(function() {
        var id = $(this).data("id");
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              type: "POST",
              url: "deletestaff.php",
              data: {
                id: id
              },
              success: function(response) {
                if (response === "success") {
                  // Show a success alert using SweetAlert
                  Swal.fire(
                    "Deleted!",
                    "The staff member has been deleted.",
                    "success"
                  ).then(() => {
                    location.reload(); // Reload the page
                  });
                } else {
                  // Show an error alert using SweetAlert
                  Swal.fire("Error!", response, "error");
                }
              },
              error: function() {
                // Show an error alert using SweetAlert if the AJAX request fails
                Swal.fire("Error!", "Something went wrong.", "error");
              },
            });
          }
        });
      });
    });
  </script>
</body>

</html>