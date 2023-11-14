

<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$db = "courier_db";

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $db);

// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
?>