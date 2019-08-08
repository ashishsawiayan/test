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

session_start();
$id=$_SESSION['id'];
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$clg=$_POST["college"];
$start=$_POST["start_date"];
$end=$_POST["end_date"];
$degree=$_POST["degree"];
$stream=$_POST["stream"];
$pscale=$_POST["performance_scale"];
$perf=$_POST["performance"];

//echo $clg

$sql = "delete from education where id='$id'";
$conn->query($sql);

$sql = "insert into education
        values('$id','$clg','$start','$end','$degree','$stream','$pscale','$perf')";
$conn->query($sql);
//$result = $conn->query($sql);

//$c=0;

  header("Location:profile.php");


$conn->close();
?>


</body>

</html>