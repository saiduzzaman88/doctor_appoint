<?php

      $d_id = $_COOKIE["d_id"];
      $d_name = $_COOKIE["d_name"];
	
	
?>


<!DOCTYPE html>
<html>
<head>
<title>Appointment:ViewHistory</title>
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
  <li><a class="active" href="doctorpphistory.php">particular patient history</a></li>
  <li><a href="doctorspdetails.php">Search Patient details</a></li>
  <li><a href="doclogout.php">Logout</a></li>
</ul>
<h1 class="ex1"> Treatment History</h1>
<h1 style="color:red;color: red; padding-left: 900px;"> Doctor's Appointment</h1>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  
	   patient Id:<input type="text" name="p_id" id="p_id">
        
		<br>
        <input class="button" type="submit" value="Search History">
        <br>
	  
	  </form>


        <table id="history" style="width:50%" border = "9">  <!-- only bordar = "number" dileo hoy abar table{} class er moto kore dileo hoy -->
  <tr>
    <th>Patient Id</th>
	<th>Patient Name</th>
    <th>Category</th> 
    <th>Doctor</th>
	<th>Date(dd/mm/yy)</th>
	<th>Time</th>
  </tr>
  
  <?php
  
     
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
		 $p_id = $_POST["p_id"];
      $hostname="localhost";
	 $username="root";
	 $password="";
	 $dbname="cmpt";
	 $connect = mysqli_connect($hostname, $username, $password, $dbname);
	 
	 $sql="SELECT * FROM history WHERE d_name = '$d_name' AND p_id='$p_id'";
      $result = mysqli_query($connect,$sql)or die(mysql_error());
	  $result2 = mysqli_query($connect,$sql)or die(mysql_error());
	  //$row = mysqli_fetch_array($result);
     
	  $row2 = mysqli_fetch_array($result2);
	 echo "<h3>Treatment history for patient:</h3>";
	 echo "<h3>ID:".$row2["p_id"]."</h3>";
	 echo "<h3>Name:".$row2["p_name"]."</h3>";

    
	while($row = mysqli_fetch_array($result)) {
    echo "<tr><td>"
	
.$row["p_id"]."</td><td>".$row["p_name"]."</td><td>".$row["d_category"]."</td><td>".$row["d_name"]."</td><td>".$row["date"]."</td><td>".$row["time"].
	
	"</td></tr>";
}
    
	 }
  
  ?>
  <!---->
  <!--
  <tr>
    <td>1001</td>
    <td>Heart</td>
    <td>MR. y</td>
	<td>21-04-19</td>
	<td>11:30 am</td>
  </tr>
  -->
</table>
  <br>
	

</body>
</html>

















