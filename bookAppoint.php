<?php
		$pid = "";
	 $hostname="localhost";
	 $username="root";
	 $password="";
	 $dbname="cmpt";
	 $connect = mysqli_connect($hostname, $username, $password, $dbname);
		   
		  
    //echo "Value is: " . $_COOKIE["id"];

	
		   /* $query = "SELECT * FROM login";
	        $result = mysqli_query($connect, $query) or die(mysql_error());
			//echo mysqli_num_rows($result);
			$row = mysqli_fetch_array($result);*/
			
			 $query2 = "SELECT * FROM doctor";
	        $result2 = mysqli_query($connect, $query2) or die(mysql_error());
			//$row2 = mysqli_fetch_array($result2);
		
//And then do whatever you want to do with it
?>

<?php
            
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$date = $_POST["date"];
	  setcookie("date", $date, time() + (86400 * 30), "/"); // 86400 = 1 day
	  
	
	
}
			
?>


<!DOCTYPE html>
<html>
<head>
<title>Appointment:New Booking</title>	
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#category').on('change',function(){
        var cate = $(this).val();
        if(cate){
            $.ajax({
                type:'POST',
                url:'getdoc.php',
                data:'q='+cate,
                success:function(html){
                    $('#doctor').html(html);
                    $('#time').html('<option value="">Select Doctor first</option>'); 
                }
            }); 
        }else{
            $('#doctor').html('<option value="">Select Category first</option>');
            $('#time').html('<option value="">Select Date & Doctor first</option>'); 
        }
    });
    
    $('#doctor').on('change',function(){
        var doc = $(this).val();
        if(doc){
            $.ajax({
                type:'POST',
                url:'getdoc.php',
                data:'p='+doc,
                success:function(html){
                    $('#time').html(html);
                }
            }); 
        }else{
            $('#time').html('<option value="">Select Date & Doctor first</option>'); 
        }
    });
	
	
});
</script>

  
<ul id ="v1" >
  <li> <a href="Mydetails.php">My Details </a> </li>
  <li> <a href="ViewHistory.php">View History</a></li>
  <li> <a class="active" href="bookAppoint.php">Book Appointment</a></li>
  <li> <a href="ViewBooking.php">View Bookings</a></li>
  <li> <a href="CancelBook.php">Cancel Bookings</a></li>
  <li> <a href="AllDoctors.php">All Doctors</a></li>
  <li> <a href="plogout.php">Logout</a></li>
</ul>

<h1 class="ex1"> New Bookings</h1>
<h1 style="color:red;color: red; padding-left: 900px;"> Doctor's Appointment</h1>
      
	  
	    
	    <script src="jquery-3.3.1.js" type="text/javascript"></script>
	    <script src="jquery-ui.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="jquery-ui.css">
		
		<?php
		$tomorrow = date("d/m/Y", strtotime('tomorrow'));
		?>
		
	
	  	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	
	
	          <!-- <input type="submit" name="submit" value="Choose" >-->
	</form>

	<script>
	
	$(function(){
		
		$("#date").datepicker({
			dateFormat : "dd/mm/yy",
			
			//now off all prev date
			
			minDate : 1,
			
			//now of all dates after 14 days
			
			maxDate : 14,
			
		});
		
		
	});
	
</script>

	<form action="gettime.php" method="GET">
	<br>
	<label for="userid"><b>Appointment Id: </label>
        <input type="text" id="userid" name="userid" cols="40" rows="1" value="<?php echo $_COOKIE["id"]; ?>" readonly>
<br><br>
    
	Choose Date: <input type="text" name="date" id="date" value='<?php echo $tomorrow;?>'>
  
  <br>

	<label for="category">Category:</label>
	<select id="category" name="category">
    <option value="">Select Category</option>
    <?php
    
        while($row2 = mysqli_fetch_array($result2)){ 
            echo '<option value="'.$row2['d_category'].'">'.$row2['d_category'].'</option>';
        }
    ?>
</select>

<br>
<label for="doctor">Doctor:</label>
<select id="doctor" name= "doctor">
    <option value="">Select Category first</option>
</select>

<br>
<label for="time">Time:</label>
<select id="time" name= "time">
    <option value="">Select Doctor first</option>
</select>

  <br>
  <!--<button onclick="post()"> Book  </button>-->
  
  <input class="button" type="submit" name="submit" value="Book" >
 	
	</form>
	
	
		
		<script>
		//try without ajax this following task. just redirect to gettime.php
		
		/*
		function post(){
			
			
			var str = document.getElementById("category").value;
			var str1 = document.getElementById("doctor").value;
			var str2 = document.getElementById("time").value;
			var str3 = document.getElementById("date").value;
			//document.getElementById("showdoc").innerHTML = str3;
			
			
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("showdoc").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","gettime.php?catedata="+str+"&docdata="+str1+"&timedata="+str2+"&datedata="+str3,true);
        xmlhttp.send();
		
    }*/
	    
		
		</script>
		
		

</body>
</html>













