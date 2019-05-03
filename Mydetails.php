
	   
	   	<?php 
		
		$p_id = $_COOKIE["id"];
		//$date_check = $_COOKIE["date"];
	
	    $hostname="localhost";
	 $username="root";
	 $password="";
	 $dbname="cmpt";
	 $connect = mysqli_connect($hostname, $username, $password, $dbname);
	 
	 $sql="SELECT * FROM patient WHERE p_id = '$p_id'";
      $result = mysqli_query($connect,$sql)or die(mysql_error());
	  $row = mysqli_fetch_array($result);
	 
	 
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$p_address = $_POST["address"];
	$p_phone = $_POST["phone"];
	//$p_email = $_POST["pemail"];
	
	$sql2="UPDATE patient SET p_address='$p_address' , p_phone='$p_phone' WHERE p_id='$p_id'";
      //$result2 = mysqli_query($connect,$sql2)or die(mysql_error());
	  //$row2 = mysqli_fetch_array($result2);
	  if($connect->query($sql2) === TRUE){
		            $message = "Successfully Updated, Please refresh the page";
                    echo "<script type='text/javascript'>alert('$message');</script>";
					//header("Location: Mydetails.php");
				}
	
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Appointment:MyDetails</title>
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
</style>

<ul method ="GET" id ="v1">
  <li><a class="active" href="Mydetails.php">My Details</a></li>
  <li><a href="ViewHistory.php">View History</a></li>
  <li><a href="bookAppoint.php">Book Appointment</a></li>
  <li><a href="ViewBooking.php">View Bookings</a></li>
  <li><a href="CancelBook.php">Cancel Bookings</a></li>
  <li><a href="AllDoctors.php">All Doctors</a></li>
  <li><a href="plogout.php">Logout</a></li>
</ul>

<h1 class="ex1"> Patient Details</h1>
<h1 style="color:red;color: red; padding-left: 900px;"> Doctor's Appointment</h1>


    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<br>
         <label for="userid"><b>User Id: </label>
        <textarea id="userid" name="userid" cols="40" rows="1" readonly> <?php echo $row["p_id"]; ?> </textarea>

<br><br>

         <label for="pname"><b>Patient Name: </label>
        <textarea id="pname" name="pname" cols="35" rows="1" readonly> <?php echo $row["p_name"]; ?>  </textarea>

<br><br>
         <label for="address"><b>Address: </label>
        <textarea id="address" name="address" cols="40" rows="3"> <?php echo $row["p_address"]; ?>  </textarea> *Changeable
		
<br><br>
         <label for="phone"><b>Phone no: </label>
        <textarea id="phone" name="phone" cols="39" rows="1"> <?php echo $row["p_phone"]; ?> </textarea> *Changeable
<br><br>
         <label for="pgender"><b>Gender: </label>
        <textarea id="pgender" name="pgender" cols="34" rows="1" readonly> <?php echo $row["p_gender"]; ?>  </textarea>

<br><br>
         <label for="pemail"><b>Email add: </label>
        <textarea id="pemail" name="pemail" cols="38" rows="1" readonly> <?php echo $row["p_email"]; ?>  </textarea>

<br><br>
         <label for="hcard"><b>Health card no: </label>
        <textarea id="hcard" name="hcard" cols="34" rows="1" readonly> <?php echo $row["h_card"]; ?>  </textarea>
<br><br>


  <input class="button" type="submit" value="Update">
  <br>
  
  </form>
	<?php
    //echo "My first PHP script!";
       ?> 

</body>
</html>

















