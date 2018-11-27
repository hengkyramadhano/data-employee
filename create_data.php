<?php

if (isset($_POST['naDep']) && isset($_POST['naBel']) && isset($_POST['dob']) && isset($_POST['telepon']) && isset($_POST['email']) && isset($_POST['provinsi']) && isset($_POST['kota']) && isset($_POST['jalan']) && isset($_POST['kdPos']) && isset($_POST['noKtp']) && isset($_POST['rekBank']) && isset($_POST['noRek']) ) { 
    $naDep = $_POST['naDep'];
    $naBel = $_POST['naBel'];
    $dob = $_POST['dob'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $provinsi = $_POST['provinsi'];
    $kota = $_POST['kota'];
    $jalan = $_POST['jalan'];
    $kdPos = $_POST['kdPos'];
    $noKtp = $_POST['noKtp'];
    $rekBank = $_POST['rekBank'];
    $noRek = $_POST['noRek'];
}

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
// echo $provinsi;
// if($provinsi === '1'){
// 	$namaProv = "Jakarta";
// }else if($provinsi === '2'){
// 	$namaProv = "Jawa Barat";
// }else if($provinsi === '3'){
// 	$namaProv = "Jawa Timur";
// }else if($provinsi === '4'){
// 	$namaProv = "Sulawesi Tenggara";
// }

$target_dir = "pics/";
$target_file = $target_dir . basename($_FILES["img"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

if(isset($_POST['save_btn'])){
	$filetemp = $_FILES['img']['tmp_name'];
	$filename = $_FILES['img']['name'];
	$filepath = "pics/".$filename;

	move_uploaded_file($filetemp, $filepath);

	$query = mysql_query($conn,"call imageInsert('$filename','$filepath')");
	if($query){
		echo "Successfuly!";
	}else {
			echo "Failed!";
	}
	
}
// if(isset($_POST["save_btn"])) {
//     $check = getimagesize($_FILES["img"]["tmp_name"]);
//     if($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }


$sql = "INSERT INTO employee (naDep, naBel, dob, telpon, email, provinsi, kota, jalan, kdPos, noKtp, rekBank, noRek) VALUES ('$naDep', '$naBel', '$dob', '$telepon', '$email', '$provinsi', '$kota', '$jalan', '$kdPos', '$noKtp', '$rekBank', '$noRek')";

if (mysqli_query($conn, $sql)) {
   //  echo "New record created successfully";
    echo "<script language='javascript'> 
			document.location.href = '../developer-test/index.php'; 
			</script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>