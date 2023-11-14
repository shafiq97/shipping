<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
  $id = $_POST['id'];

  // Perform the deletion
  $result = mysqli_query($conn, "DELETE FROM branch_tbl WHERE `branch_id`='$id'");

  if ($result) {
    echo "success";
  } else {
    echo "error";
  }
}
