<!DOCTYPE HTML>
<html>

<head>
    <style>
    .login {
        margin: auto;
        width: 50%;
        border: 3px solid #73AD21;
        padding: 10px;
    }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>



    <?php
//$msg="";
if(isset($_REQUEST['d']))
{
echo"<script>alert('Logged out')</script>";

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
          
            echo "User already exits please login";
           $c=1;
           
           break;
       }
    }

if($c==0){
 $name=$_POST["name"];
$email=$_POST["email"];
$pass=md5($_POST["pass"]);
$sql = "INSERT INTO user (name, email,pass)
VALUES ('$name', '$email','$pass')";
$conn->query($sql); 

echo "successfully registered";
}
$conn->close();
}
?>

    <div class="mt-4" align="center">
        <div style="background-color: #f2e6ff" class="login">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                <input type="text" name="name" value="" required>
                <br>
                <br>
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <input type="text" name="email" value="" required>
                <br>
                <br>
                <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                <input type="password" name="pass" value="" required>
                <br>
                <br>
                <input type="submit" class="btn btn-outline-success" name="submit" value="Register">
            </form>
            <br>
            <form action="login.php" method="post">

                <button type="submit" class="btn btn-outline-primary" name="login" value="Login">Login</button>
            </form>
        </div>
    </div>
    <?php

?>
</body>

</html>