
<?php
//Include the database configuration file
     $hostname="localhost";
	 $username="root";
	 $password="";
	 $dbname="cmpt";
	 $connect = mysqli_connect($hostname, $username, $password, $dbname);
	 
	 mysqli_select_db($connect,"ajax_demo");

	 //cate
if(!empty($_POST["q"])){
	
    //Fetch all Doctor data
    $query3 = "SELECT * FROM doctor where d_category= '".$_POST['q']."'";			
	$result3 = mysqli_query($connect, $query3) or die(mysql_error());

    
    //Doctor option list
   
        echo '<option value="">Select Doctor</option>';
        while($row3 = mysqli_fetch_array($result3)){ 
            echo '<option value="'.$row3['d_name'].'">'.$row3['d_name'].'</option>';
        }
    //doc
}elseif(!empty($_POST["p"])){
    //Fetch all time data  //
	//echo "Value is: " .$_COOKIE["date"];
	//$date = "2019-03-15";
	//$date=$_COOKIE["dateval"];
	//echo $date;

	$date = $_COOKIE["date"];
	
   $query4 = "SELECT * FROM avail";			
   $result4 = mysqli_query($connect, $query4) or die(mysql_error());
    
    //Time option list
   
        echo '<option value="">Select time</option>';
        while($row4 = mysqli_fetch_array($result4)){ 
            echo '<option value="'.$row4['time'].'">'.$row4['time'].'</option>';
        }
  
}
?>
	
	
	
	
	
	