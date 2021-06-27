<!DOCKTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0;">
    <title>login form</title>
    <link rel="stylesheet" type="text/css" href="login.css">
  </head>
  <body>
    <?php
  		session_start();
// define variables and set to empty values
$Usern=$type= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  if (empty($_POST["Usern"])) {
	    $Stu_nErr = "Name is required";
	  } else {
	    $Usern = test_input($_POST["Usern"]);

	  }
	  
	  if (empty($_POST["type"])) {
	    $Phon_Err = "Password is required";
	  } else {
	    $type = test_input($_POST["type"]);
	    
	  }
  
}

  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>

  <div class="container">
    <div class="top"></div>
    <div class="bottom"></div>
    <div class="center">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
      <center><h2> LOG IN</h2></center>
      <input type="text" name="Usern" placeholder="Username"/>
      <input type="password" name="type" placeholder="password"/>
      <input type="submit" name="submit" value="Login" class="btn btn-primary">
      <br><br>
      <center>
      <button class="sign"><a href="signup.php" class="signupbtn">Sign up</a></button>
</center>
</form>
    </div>
  </div>     
      
    
  

  
 
<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$Sub_id=$last_pay="";


  if(isset($_POST['submit']))
   
  { 
    try 
    {
      $conn = new PDO("mysql:host=localhost;dbname=tm2","root","1234");
  // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      $sql = "select password from userinfo where username='$Usern'";
  

    $pass=0;
  $obj=$conn->prepare($sql);
  $obj->execute();
  $pass=$obj->fetchColumn();

  if($type==$pass)
  {  
    echo "<script> location.href='home.html'; </script>";
        exit();
   #redirect('home.html');
  }
  else
  {
  ?><script> alert("Wrong Username or Password")</script><?php
  }

    
  
 

  } catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  }

    
   }
  
?>
    
   </body>
    
    </html> 

