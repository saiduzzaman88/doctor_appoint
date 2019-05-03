<?php


      $p_id = $_COOKIE["id"];
	
	 $hostname="localhost";
	 $username="root";
	 $password="";
	 $dbname="cmpt";
	 $connect = mysqli_connect($hostname, $username, $password, $dbname);
	 
	 $sql="SELECT * FROM doctor ORDER BY d_category";
      $result = mysqli_query($connect,$sql)or die(mysql_error());
	  //$row = mysqli_fetch_array($result);

?>


<!DOCTYPE html>
<html>
<head>
<title>Appointment:Our Doctors</title>
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
  <li><a href="Mydetails.php">My Details</a></li>
  <li><a href="ViewHistory.php">View History</a></li>
  <li><a href="bookAppoint.php">Book Appointment</a></li>
  <li><a href="ViewBooking.php">View Bookings</a></li>
  <li><a href="CancelBook.php">Cancel Bookings</a></li>
  <li><a class="active" href="AllDoctors.php">All Doctors</a></li>
  <li><a href="plogout.php">Logout</a></li>
</ul>

<h1 class="ex1"> Doctor's List</h1>
<h1 style="color:red;color: red; padding-left: 900px;"> Doctor's Appointment</h1>

<br>
        <table id="history" style="width:50%" border = "9">  <!-- only bordar = "number" dileo hoy abar table{} class er moto kore dileo hoy -->
  <tr>
    <th>Doctor Name</th>
    <th>Category</th> 
	<th>Email Address</th> 
  </tr>
  
  <?php
    
	while($row = mysqli_fetch_array($result)) {
    echo "<tr><td>"
	
          .$row["d_name"]."</td><td>".$row["d_category"]."</td><td>".$row["d_email"].

	"</td></tr>";
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
	<?php
    //echo "My first PHP script!";
       ?> 

</body>
</html>

















