<?php

     $hostname="localhost";
	 $username="root";
	 $password="";
	 $dbname="cmpt";
	 $connect = mysqli_connect($hostname, $username, $password, $dbname);
	 
	 $sql="SELECT * FROM patient";
      $result = mysqli_query($connect,$sql)or die(mysql_error());
	  //$row = mysqli_fetch_array($result);

?>


<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}

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
</head>
<body>  

<?php
// define variables and set to empty values

$check_id= $check_name= $check_email= $check_card= $check_gender=$check_phone=$check_pass =True;

$nameErr = $emailErr = $genderErr = $phoneErr = $idErr= $passErr= $hcErr= "";
$p_id = $p_name = $p_email = $p_address = $p_phone = $h_card= $p_gender= $p_pass="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["p_name"])) {
	  $check_name = False;
    $nameErr = "Name is required";
  } else {
    $p_name = test_input($_POST["p_name"]);
	$check_name = True;
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$p_name)) {
		$check_name = False;
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["p_email"])) {
	  $check_email = False;
    $emailErr = "Email is required";
  } else {
	  $check_email = True;
    $p_email = test_input($_POST["p_email"]);
    // check if e-mail address is well-formed
    if (!filter_var($p_email, FILTER_VALIDATE_EMAIL)) {
		$check_email = False;
      $emailErr = "Invalid email format"; 
    }
  }
    
  if (empty($_POST["p_address"])) {
    $p_address = "";
  } else {
    $p_address = test_input($_POST["p_address"]);
    
  }


  if (empty($_POST["p_gender"])) {
	  $check_gender = False;
    $genderErr = "Gender is required";
  } else {
	  $check_gender = True;
    $p_gender = test_input($_POST["p_gender"]);
  }
  
  if (empty($_POST["p_phone"])) {
	  $check_phone = False;
    $phoneErr = "Phone no is required";
  } else {
	  $check_phone = True;
	  $p_phone = test_input($_POST["p_phone"]);
	  //$n = "(123)456-7890";
      //$p = "/\(\d{3}\)\d{3}-\d{4}/";
	  $p = "/\d{10}/";
	  
	  if(!preg_match($p,$p_phone)){
		  $check_phone = False;
		  $phoneErr = "Invalid Phone number format";
	  }
    
  }
  
  //Checking for unique p_id
    
	if (empty($_POST["p_id"])) {
		$check_id = False;
    $idErr = "Unique UserId is required";
  } else {
	  $p_id = test_input($_POST["p_id"]);
	  $check_id = True;
	  while($row = mysqli_fetch_array($result))
	  {
		  if($row["p_id"] == $p_id){
			  $check_id = False;
			  $idErr = "Unique Id Needed";
		  }
	  }
    
  }
     //Checking for p_pass
    if (empty($_POST["p_pass"])) {
		$check_pass = False;
    $passErr = "Password is required";
  } else {
	  $p_pass = test_input($_POST["p_pass"]);
	  $check_pass = True;
	  $password_hash = md5($p_pass);
    
  }
  
   
    if (empty($_POST["h_card"])) {
		$check_card = False;
    $hcErr = "health card no is required";
  } else {
	  $h_card = test_input($_POST["h_card"]);
	  $check_card = True;
    
  }
  
  if($check_id==TRUE && $check_name==TRUE && $check_email==TRUE && $check_card==TRUE && $check_gender==TRUE && $check_phone==TRUE && $check_pass=TRUE){

           $query3 = "insert INTO patient (p_name,p_id,p_pass,h_card,p_phone,p_email,p_address,p_gender) VALUES 
			('$p_name','$p_id','$password_hash','$h_card','$p_phone','$p_email','$p_address','$p_gender')" ;
             //echo $query3;
			
			if($connect->query($query3) === TRUE){
					$message = "Successfully Registered, Please go to the Homepage to Login";
                    echo "<script type='text/javascript'>alert('$message');</script>";
					//header("Location: Bookwrong.php");
				}
				
          else{ 
		  
		         $message = "Error,Please try again";
                    echo "<script type='text/javascript'>alert('$message');</script>";
					
					//echo("Error description: " . mysqli_error($connect));
		  }	 
	 }
	 else{
		 $message = "Invalid input";
                    echo "<script type='text/javascript'>alert('$message');</script>";
	 }
  
  
}

        
  
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Registration form</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">



  UserId: <input type="text" id = "p_id" name="p_id" value="<?php echo $p_id;?>">
  <span class="error">* <?php echo $idErr;?></span>
  <br><br>
  Password: <input type="password" id = "p_pass" name="p_pass" value="<?php echo $p_pass;?>">
  <span class="error">* <?php echo $passErr;?></span>
  <br><br>
  Name: <input type="text" id = "p_name" name="p_name" value="<?php echo $p_name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" id = "p_email" name="p_email" value="<?php echo $p_email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Phone: <input type="text" id = "p_phone" name="p_phone" value="<?php echo $p_phone;?>" placeholder="Format: 3062033669">
  <span class="error">* <?php echo $phoneErr;?></span>
  <br><br>
  Address: <textarea id = "p_address" name="p_address" rows="5" cols="40"><?php echo $p_address;?></textarea>
  <br><br>
  Health Card No: <input type="text" id = "h_card" name="h_card" value="<?php echo $h_card;?>">
  <span class="error">* <?php echo $hcErr;?></span>
  <br><br>
  Gender:
  <input type="radio" name="p_gender" <?php if (isset($p_gender) && $p_gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="p_gender" <?php if (isset($p_gender) && $p_gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="p_gender" <?php if (isset($p_gender) && $p_gender=="other") echo "checked";?> value="other">Other  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input class="button" type="submit" name="submit" value="Submit">

  </form>

      <a href="home.html" target="blank">Go To Homepage</a>
	  
<?php

/*

          echo "<h2>Your Input:</h2>";
      echo $p_id;
       echo "<br>";
	   echo $p_pass;
         echo "<br>";
       echo $p_name;
       echo "<br>";
        echo $p_email;
        echo "<br>";
        echo $p_address;
         echo "<br>";
         echo $p_phone;
         echo "<br>";
		 echo $h_card;
         echo "<br>";
		 echo $p_gender;
         echo "<br>";
	   */
	   
	   
     
	 


?>

</body>
</html>