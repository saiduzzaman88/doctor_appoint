
<!DOCTYPE html>
<html>
<head>
<title>Appointment:Doctor</title>
</head>
<body>

<?php 
    
     $hostname="localhost";
	 $username="root";
	 $password="";
	 $dbname="cmpt";
	 $connect = mysqli_connect($hostname, $username, $password, $dbname);
	 if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
} 

echo nl2br("\n");  //new line
	 
	 
		static $id=""; static $pass="";
		
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
						
			$id = $_POST["id"];		
			$pass=$_POST["pass"];
			
			//echo $id;
			echo nl2br("\n");  //new line 
			//echo $pass;
			echo nl2br("\n");  //new line
			
			$query = "SELECT * FROM doctor where d_id = '$id'";
			//echo nl2br("\n");  //new line
			//echo $query;
	        $result = $connect->query($query);
			
			
			//$row = mysqli_fetch_array($result);
			
			if (mysqli_num_rows($result) > 0) {
				
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		
		   $password_hash = md5($pass);
        
			if($password_hash ===  $row["d_pass"]){
				$id_n = "d_id"; $d_n = "d_name"; 
				setcookie($id_n, $id, time() + (86400 * 30), "/"); // 86400 = 1 day
				
				setcookie($d_n, $row["d_name"], time() + (86400 * 30), "/"); // 86400 = 1 day
				/*$query2 = "insert INTO login(p_id, number) VALUES ('$id','1')" ;
				if($connect->query($query2) === TRUE){
					echo "interted";
				}*/
				
				
				header("Location: doctorservepatient.php");
				
			}
			else{
				//echo "Wrongggggggggggggggggggggg pass";
				$message = "Error in Login:Wrong Password, Please try again!!!!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
					echo '<a href="mainpage.html" target="blank">Click to try again</a>';
			}
		
		}
} else {
    //echo "Wrong Username";
	$message = "Error in Login:Wrong UserID, Please try again!!!!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
					echo '<a href="mainpage.html" target="blank">Click to try again</a>';
}
			
			
			
		}
//And then do whatever you want to do with it
?>


</body>
</html> 















