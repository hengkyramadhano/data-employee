<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "employees";

// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $dbname);
// // Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

require_once "db_config.php";

$sql = "INSERT INTO employee (naDep, naBel, email, noKtp)
VALUES ('Hengky', 'Ramadhano', 'hengkyramadhano@gmail.com', '90777878888999')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>