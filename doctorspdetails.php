<?php

      $d_id = $_COOKIE["d_id"];
      $d_name = $_COOKIE["d_name"];
	
	
?>


<!DOCTYPE html>
<html>
<head>
<title>Appointment:patientDetails</title>
</head>
<body>
<style> 
ul{
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333333;
}

li {
  float: left;
  background-color:red;
  border: 2px solid black;
  border-radius:12px;
}
li a:hover:not(.active) {
  background-color: green;
}
.active {
  background-color: #4CAF50;
  border: 2px solid black;
  border-radius:12px;
}
li a {
  display: block;
  color: white;
  text-align: center;
  padding: 16px;
  text-decoration: none;
}

li a:hover {
  background-color: green;
}
</style>

<style>
body {
  background-color: lightblue;
  background-image: url("doctors.png");
  background-size: 45%;
 
  background-repeat: no-repeat;
  background-attachment: fixed;
    background-position:right bottom;
}

.ex1 {
  color: blue;
  padding-right:100px;
  text-align:center;
  text-decoration: underline;
}

select {
  width: 20%;
  padding: 12px 20px;
  margin: 8px 0;
 
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.button:hover {
  color: white;
  background-color:green;
}
.button {
  background-color: RED;
  border: 8px solid #ccc;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 50%;
}
#history td, #history th {
  border: 1px solid #ddd;
  padding: 8px;
}
#history th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}

</style>

<ul id ="v1" >
  <li><a href="doctormydetails.php">My Details</a></li>
  <li><a href="doctorviewhistory.php">View History</a></li>
  <li><a href="doctorservepatient.php">Serve patient</a></li>
  <li><a href="doctorviewbooking.php">View Bookings</a></li>
  <li><a href="doctorpphistory.php">particular patient history</a></li>
  <li><a class="active" href="doctorspdetails.php">Search Patient details</a></li>
  <li><a href="doclogout.php">Logout</a></li>
</ul>
<h1 class="ex1"> Patient Details</h1>
<h1 style="color:red;color: red; padding-left: 900px;"> Doctor's Appointment</h1>

<br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  
	   patient Id:<input type="text" name="p_id" id="p_id">
        
		<br><br>
        <input class="button" type="submit" value="Search Patient">
        <br>
	  
	  </form>

<br>
       
  <?php
  
     
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
		 $p_id = $_POST["p_id"];
      $hostname="localhost";
	 $username="root";
	 $password="";
	 $dbname="cmpt";
	 $connect = mysqli_connect($hostname, $username, $password, $dbname);
	 
	 $sql="SELECT * FROM patient WHERE p_id='$p_id'";
      $result = mysqli_query($connect,$sql)or die(mysql_error());
	  //$row = mysqli_fetch_array($result);

    
	while($row = mysqli_fetch_array($result)) {
    
	echo 'Patient Id: <input type="text" name="p_id6" id="p_id6" value="'.$row["p_id"].'"readonly>';
	echo "<br><br>";
	echo 'Patient name: <input type="text" name="p_id" id="p_id" value="'.$row["p_name"].'"readonly>';
	echo "<br><br>";
	echo 'Patient phone: <input type="text" name="p_id2" id="p_id2" value="'.$row["p_phone"].'"readonly>';
	echo "<br><br>";
	echo 'Patient email: <input type="text" name="p_id3" id="p_id3" value="' .$row["p_email"].'"readonly>';
	echo "<br><br>";
	echo 'Patient Gender: <input type="text" name="p_id4" id="p_id4" value="'.$row["p_gender"].'"readonly>';
	echo "<br><br>";
	echo 'Patient health card: <input type="text" name="p_id5" id="p_id5" value="'.$row["h_card"].'"readonly>';
	echo '<h3>Send e-mail to patient: '.$row["p_name"].'</h3>';
    
	
	echo '<form action="mailto:'.$row["p_email"].'" method="post" enctype="text/plain">

Doctor Name:<br>
<input type="text" name="Doctor name:"><br>

Comment:<br>
<input type="text" name="comment" size="50"><br><br>
<input type="submit" value="Send">
<input type="reset" value="Reset">
</form>';
	
}

	 }
  
  ?>
 
	

</body>
</html>


















