<?php include('session.php');
include('config.php'); ?>
<?php include 'layouts/admin_header.php'; ?>

<body>
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
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Shipments List</h3>
      </div>
      <div class="panel-body">
        <table class="table table-striped table-hover">
          <thead>
            <th>id</th>
            <th>sender_name</th>
            <th>sender_mobile</th>
            <th>sender_address</th>
            <th>recipient_name</th>
            <th>recipient_mobile</th>
            <th>package_no</th>
            <th>payment</th>
            <th>destination</th>
            <th>departure_datetime</th>
            <th>pickup_datetime</th>
            <th>description</th>
            <th>Delete</th>
          </thead>
          <tbody>
            <?php
            $count = 1;
            $sel_query = "SELECT * FROM shipments_tbl ORDER BY id DESC; ";
            $result = mysqli_query($conn, $sel_query);
            while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["sender_name"]; ?></td>
                <td><?php echo $row["sender_mobile"]; ?></td>
                <td><?php echo $row["sender_address"]; ?></td>
                <td><?php echo $row["recipient_name"]; ?></td>
                <td><?php echo $row["recipient_mobile"]; ?></td>
                <td><?php echo $row["package_no"]; ?></td>
                <td><?php echo $row["payment"]; ?></td>
                <td><?php echo $row["destination"]; ?></td>
                <td><?php echo $row["departure_datetime"]; ?></td>
                <td><?php echo $row["pickup_datetime"]; ?></td>
                <td><?php echo $row["description"]; ?></td>
                <td>
                  <button class="btn btn-warning delete-btn" data-id="<?php echo $row["id"]; ?>">
                    <i class="fa fa-trash"></i> Delete
                  </button>
                </td>
              </tr>
            <?php $count++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include 'layouts/footer.php'; ?>

  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>

  <script>
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
              url: "delete_shipments.php",
              data: {
                id: id
              },
              success: function(response) {
                if (response === "success") {
                  location.reload();
                } else {
                  Swal.fire("Error!", "Something went wrong.", "error");
                }
              },
            });
          }
        });
      });
    });
  </script>
</body>

</html>