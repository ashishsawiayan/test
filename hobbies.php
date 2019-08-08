<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "mydb";
  
  session_start();
  $id=$_SESSION['id'];
  // Create connection
  $conn = new mysqli($servername, $username, $password,$dbname);
  
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 
  
  $h1=$_POST["hobby1"];
  $h2=$_POST["hobby2"];
  $h3=$_POST["hobby3"];
  $h4=$_POST["hobby4"];
  //$link=$_POST["project_link"];
  
  $sql = "delete from hobbies where id='$id'";
  $conn->query($sql);
  
  $sql = "insert into hobbies
          values('$id','$h1','$h2','$h3','$h4')";
  $conn->query($sql);
  //$result = $conn->query($sql);
  
  //$c=0;
  
    header("Location:profile.php");
  
  
  $conn->close();
  ?>
    
?>