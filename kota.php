<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employees";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$prov_id = $_POST['prov_id'];

$sql_kota = mysql_query($conn, "SELECT * FROM kota WHERE prov_id = $prov_id");

echo '<option>Choose City</option>';
while ($row_kota = mysqli_fetch_array($sql_kota)) {
	echo '<option value="'.$row_kota['id'].'">'.$row_kota['nama_kota'].'</option>';
}
?>