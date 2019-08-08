<!DOCTYPE HTML>
<html>

<head>
</head>

<body>
    <?php

 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM user";
$result = $conn->query($sql);

$c=0;
while($row = $result->fetch_array()) {
   if($row["email"]==$_POST["email"])
   {
      if($row["pass"]==md5($_POST["pass"]))
      {
       echo" <script>
        alert('Login Successful');
        </script>";
      session_start();
      $_SESSION['id']=$row["id"];
      $_SESSION['name']=$row["name"];
      $_SESSION['email']=$row["email"];
      
      }else
      {
        header("Location:login.php?c=1");
        $c=1;
      }
   }
}
if($c==0)
{
  header("Location:profile.php");
}


$conn->close();
?>


</body>

</html>