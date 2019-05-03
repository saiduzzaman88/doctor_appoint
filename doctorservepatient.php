<?php


      $d_id = $_COOKIE["d_id"];
	  $d_name = $_COOKIE["d_name"];
	
	 $hostname="localhost";
	 $username="root";
	 $password="";
	 $dbname="cmpt";
	 $connect = mysqli_connect($hostname, $username, $password, $dbname);
	 
	 $sql="SELECT * FROM appointment WHERE d_name = '$d_name' ORDER BY date , time";
      $result = mysqli_query($connect,$sql)or die(mysql_error());
	  //$row = mysqli_fetch_array($result);

?>

<?php

     if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$p_id = $_POST["p_id"];
	$p_name = $_POST["p_name"];
	$d_category = $_POST["d_category"];
	$d_name = $_POST["d_name"];
	$date = $_POST["date"];
	$time = $_POST["time"];
	
	//deleting from appointment
	$sql2="DELETE from appointment  WHERE p_id='$p_id' AND p_name='$p_name' AND d_category='$d_category'
          AND d_name='$d_name' AND date='$date' AND time = '$time'";
      //$result2 = mysqli_query($connect,$sql2)or die(mysql_error());
	  //$row2 = mysqli_fetch_array($result2);
	  if($connect->query($sql2) === TRUE){
		            //$message = "Successfully Canceled the booking, Please refresh the page";
                    //echo "<script type='text/javascript'>alert('$message');</script>";
					//header("Location: Mydetails.php");
				}
				else{
					$message = "Error delete. Please try again";
                    echo "<script type='text/javascript'>alert('$message');</script>";
					
				}
				
	  //inserting into history

                 $sql3="insert into history (p_id,p_name,d_category,d_name,date,time) VALUES 
			('$p_id','$p_name','$d_category','$d_name','$date','$time')" ;
				 
	  if($connect->query($sql3) === TRUE){
		            $message2 = "Successfully Served the patient, Please refresh the page";
                    echo "<script type='text/javascript'>alert('$message2');</script>";
					//header("Location: Mydetails.php");
				}
				else{
					$message2 = "Error. Please try again";
                    echo "<script type='text/javascript'>alert('$message2');</script>";
					
				}	  
	
}

     
?>


<!DOCTYPE html>
<html>
<head>
<title>Appointment:Serve patient</title>
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
  <li><a class="active" href="doctorservepatient.php">Serve patient</a></li>
  <li><a href="doctorviewbooking.php">View Bookings</a></li>
  <li><a href="doctorpphistory.php">particular patient history</a></li>
  <li><a href="doctorspdetails.php">Search Patient details</a></li>
  <li><a href="doclogout.php">Logout</a></li>
</ul>


<h1 class="ex1">To Serve an appointment, Select booking from table and press serve button</h1>
<!--<h1 style="color:red;color: red; padding-left: 900px;"> Doctor's Appointment</h1>-->

<br>

      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  
	   Patient Id:<input type="text" name="p_id" id="p_id">
        Patient Name:<input type="text" name="p_name" id="p_name">
        Category:<input type="text" name="d_category" id="d_category"> <br><br>
		Doctor:<input type="text" name="d_name" id="d_name">
		Date:<input type="text" name="date" id="date">
		Time:<input type="text" name="time" id="time">
		<br>
        <input class="button" type="submit" value="Serve">
        <br>
	  
	  </form>
  
<br>
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
    
	while($row = mysqli_fetch_array($result)) {
    echo "<tr><td>"
	
.$row["p_id"]."</td><td>".$row["p_name"]."</td><td>".$row["d_category"]."</td><td>".$row["d_name"]."</td><td>".$row["date"]."</td><td>".$row["time"].
	
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
	<script>
	//Making selectable table
    
                var table = document.getElementById('history');
                
                for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                         //rIndex = this.rowIndex;
                         document.getElementById("p_id").value = this.cells[0].innerHTML;
                         document.getElementById("p_name").value = this.cells[1].innerHTML;
                         document.getElementById("d_category").value = this.cells[2].innerHTML;
						 document.getElementById("d_name").value = this.cells[3].innerHTML;
						 document.getElementById("date").value = this.cells[4].innerHTML;
						 document.getElementById("time").value = this.cells[5].innerHTML;
                    };
                }
    
         </script>
    

</body>
</html>

















