<!DOCTYPE html>
<html>
<head>
	<title>Employee</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <script src="js/jquery-3.3.1.js"></script>
	<script>
		$(document).ready(function(){
			$('#provinsi').change(function(){
				var provinsi_id = $(this).val();

				$.ajax({
					type: 'POST',
					url: 'kota.php',
					data: 'prov_id='+provinsi_id,
					success: function(response){
						$('#kota').html(response);
					}
				});
			})
		});
	</script> -->
	<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #0c69ff;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 55px;
  right: 55px;
  width: 175px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0px;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 600px;
  padding: 30px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=email], .form-container input[type=date], .form-container input[type=Number], 
.form-container input[type=Address], .form-container select[name="rekBank"], .form-container select[name="provinsi"], .form-container select[name="kota"] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=email]:focus, 
.form-container input[type=date]:focus, .form-container input[type=Number]:focus, .form-container input[type=Address]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #0c69ff;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100px;
  margin-bottom:10px;
  margin-left: 10px;
  margin-right: 10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

li {
    float: left;
 }

</style>
</head>
<body>
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
?>
<button class="open-button" onclick="openForm()">Add New Employee</button>

<div class="form-popup" id="myForm" style="overflow: auto;">
  <form action="create_data.php" method="POST" enctype="multipart/form-data" class="form-container">
    <h1>New Employee</h1>
    <table>
    	<tr>
    		<td><label for="naDep"><b>Name<div style="color:#F00";>*</div></b></label></td>
    		<td><input type="text" placeholder="Enter First Name" name="naDep" required></td>
    		<td><input type="text" placeholder="Enter Last Name" name="naBel" required></td>
    	</tr>
    	<!-- <tr>
    		<td><label for="naBel"><b>Last Name<div style="color:#F00";>*</div></b></label></td>
    		<td><input type="text" placeholder="Enter Last Name" name="naBel" required></td>
    	</tr> -->
    	<tr>
    		<td><label for="dob"><b>Date of Birth</b></label></td>
    		<td><input type="date" placeholder="Choose date" name="dob"></td>
    	</tr>
    	<tr>
    		<td><label for="telepon"><b>Phone Number</b></label></td>
    		<td><input type="Number" placeholder="ex: 0853..." name="telepon" required></td>
    	</tr>
    	<tr>
    		<td><label for="email"><b>E-Mail</b></label></td></td>
    		<td><input type="email" placeholder="Take your email address" name="email"></td>
    	</tr>
    	<tr>
    		<td><label for="provinsi"><b>Province & City</b></label></td>
    		<?php
    		$sql_provinsi = mysqli_query($conn, 'SELECT * FROM provinsi');
    		?>
    		<td>
			  	<select name="provinsi" id="provinsi">
			    	<option value="">Choose Province</option>
			    	<?php 
			    	while ($row_provinsi = mysqli_fetch_array($sql_provinsi)) {
			    	?>
			    	<option value="<?php echo $row_provinsi['nama_prov'] ?>">
			    		<?php 
			    		$id_prov = $row_provinsi['id'];
			    		echo $row_provinsi['nama_prov']; ?>
			    	</option>
			    <?php } ?>
			  	</select><br />
			</td>
    		<!-- <td><label for="city"><b>City</b></label></td> -->
    		<?php
    		$sql_kota = mysqli_query($conn, 'SELECT * FROM kota');
    		?>
    		<td><select name="kota" id="kota">
    			<option value="">Choose City</option>
    			<?php 
			    	while ($row_kota = mysqli_fetch_array($sql_kota)) {
			    	?>
    			<option value="<?php echo $row_kota['nama_kota'] ?>">
			    		<?php echo $row_kota['nama_kota'] ?>
			    	</option>
			    	<?php } ?>
    		</select></td>
    	</tr>
    	<tr>
    		<td><label for="jalan"><b>Address</b></label></td>
    		<td><input type="Address" placeholder="Address" name="jalan"></td>
    		<td><input type="text" placeholder="Postcode" name="kdPos"></td>
    	</tr>
    	<!-- <tr>
    		<td><label for="kdPos"><b>Postcode</b></label></td></td>
    		<td><input type="text" placeholder="ex: 10230" name="kdPos"></td>
    	</tr> -->
    	<tr>
    		<td><label for="noKtp"><b>No. KTP</b></label></td>
    		<td><input type="text" placeholder="(Kartu Tanda Penduduk)" name="noKtp" required></td>
    	</tr>
    	<tr>
    		<td><label for="rekBank"><b>Bank Account</b></label></td>
    		<td>
			  	<select name="rekBank">
			    	<option value="bca">BCA</option>
			    	<option value="bni">BNI</option>
			    	<option value="bri">BRI</option>
			    	<option value="mandiri">Mandiri</option>
			  	</select>
			</td>
    	</tr>
    	<tr>
    		<td><label for="noRek"><b>Account Number</b></label></td>
    		<td><input type="text" placeholder="" name="noRek"></td>
    	</tr>
    	<tr>
    		<td><label for="img"><b>Attach KTP</b></label></td>
    		<td><label><input type="file" name="img" id="id" required></td></label>
    	</tr>
    	<!-- <tr>
    		<td><label></label></td>
    		<td><label><input type="submit"  value="SAVE"></label></td>
    	</tr> -->
    	
    </table>
    <ul align="center" style="list-style-type:none; ">
    	<li><td><button type="submit" name="save_btn" class="btn">Submit</button></td></li>
    	<li><td><button type="button" class="btn cancel" onclick="closeForm()">Close</button></td></li>
    </ul>
    </form>
</div>

<script>
function openForm() {
    document.getElementById("myForm").style.display = "block";
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}
</script>
</body>
</html>