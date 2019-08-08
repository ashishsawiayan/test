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

$title=$_POST["title"];
$start=$_POST["start_date"];
$end=$_POST["end_date"];
$des=$_POST["description"];
$link=$_POST["project_link"];

$sql = "delete from projects where id='$id'";
$conn->query($sql);

$sql = "insert into projects
        values('$id','$title','$start','$end','$des','$link')";
$conn->query($sql);
//$result = $conn->query($sql);

//$c=0;

  header("Location:profile.php");


$conn->close();
?>


</body>

</html>