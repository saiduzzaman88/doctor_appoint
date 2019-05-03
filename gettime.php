<!DOCTYPE html>
<html>
<head>

</head>
<body>


<?php


		if ($_SERVER["REQUEST_METHOD"] == "GET") {
			
$docdata = $_GET["doctor"];
$catedata = $_GET["category"];
$timedata = $_GET["time"];
$datedata = $_GET["date"];
$p_id = $_COOKIE["id"];

     $hostname="localhost";
	 $username="root";
	 $password="";
	 $dbname="cmpt";
	 $connect = mysqli_connect($hostname, $username, $password, $dbname);
	 //echo "gettike";
	 
	 mysqli_select_db($connect,"ajax_demo");
	 
	 //Checking if the doctor is booked at that particular time
	 $sql2="SELECT * FROM appointment WHERE d_category = '$catedata' AND d_name = '$docdata' AND date='$datedata' AND time='$timedata'";
	  $result2 = mysqli_query($connect,$sql2)or die(mysql_error());
	   $rowcount = $result2->num_rows;
	   
	   //Checking that if the patient is booked at that particular time with another doctor
	   $sql1="SELECT * FROM appointment WHERE p_id = '$p_id' AND date='$datedata' AND time='$timedata'";
	  $result1 = mysqli_query($connect,$sql1)or die(mysql_error());
	   $rowcount2 = $result1->num_rows;
	  
	  
	 if($rowcount == 0 && $rowcount2 == 0 && $docdata != ""){
		 
	  $sql="SELECT * FROM patient WHERE p_id = '".$_COOKIE["id"]."'";
      $result = mysqli_query($connect,$sql)or die(mysql_error());
	  $row = mysqli_fetch_array($result);
	   
	   $p_id= $row['p_id'];
	   $p_name= $row['p_name'];
	  
			
			$query3 = "insert INTO appointment(p_id,p_name,d_category,d_name,date,time) VALUES 
			('$p_id','$p_name','$catedata','$docdata','$datedata','$timedata')" ;

			
			if($connect->query($query3) === TRUE){
				$message = "Successfully Booked, Thanks!!!!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
					echo '<a href="ViewBooking.php" target="blank">Click to view bookings</a>';
					//echo "Successful booking";
					//header("Location: ViewBooking.php");
				}
				
	 }
          else{ 
		          $message = "Error in Booking:selected Time slot is not available, Please try again!!!!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
					echo '<a href="bookAppoint.php" target="blank">Click to book again</a>';
		         //header("Location: bookAppiont.php");
				 //echo "error in booking";
		  }	

     
		}	 
			
			
						?>
			
		
    
</body>  
</html>
	
	
	
	
	
	
	