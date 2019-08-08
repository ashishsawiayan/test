<!DOCTYPE HTML>
<html>

<head>
    <style>
    .skill {
        margin: auto;
        width: 60%;
        border: 3px solid #73AD21;
        padding: 10px;
        box-shadow: 10px 10px 5px grey;
        border-radius: 10px;
    }

    .edit {
        margin: auto;
        width: 60%;
        border: 1px solid #73AD21;
        padding: 10px;
        box-shadow: 10px 10px 5px grey;
        border-radius: 10px;
    }

    .submit {
        margin: auto;
        width: 60%;
        padding: 10px;

    }

    .upload-pic {
        margin: auto;
        width: 60%;
        border: 3px solid #73AD21;
        padding: 10px;
        box-shadow: 10px 10px 5px grey;
        border-radius: 10px;
    }
    </style>
</head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<body>
    <?php
session_start();
if(isset($_SESSION['id']))
$id= $_SESSION['id'];
else
header("Location:index.php");
//echo $id;
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



    /*$sql = "SELECT * FROM profile";
    $result = $conn->query($sql);

    while($row = $result->fetch_array()) {
        echo $row["address"];
        echo $row["phone"];
         echo $row["bday"];
        echo $row["gender"];
        echo $row["role"];

        echo "<br>";
    }*/


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    
$add=$_POST["address"];
$bday=$_POST["bday"];
if(isset($_POST["gender"]))
$gender = $_POST["gender"];
else
$gender="";
$phone=$_POST["ph"];
$role=$_POST["role"];

$skill=array($_POST["skill1"],$_POST["skill2"],$_POST["skill3"],$_POST["skill4"],$_POST["skill5"],$_POST["skill6"]);
//echo $skill[0];

$sql="UPDATE skills SET skill1='$skill[0]',skill2='$skill[1]',skill3='$skill[2]',skill4='$skill[3]',skill5='$skill[4]',skill6='$skill[5]' WHERE id=$id";
$conn->query($sql); 

$sql="UPDATE profile SET phone='$phone',address='$add',bday='$bday',gender='$gender',role='$role' WHERE id=$id";
$conn->query($sql); 

header("Location:profile.php");
}
$sql = "SELECT * FROM profile where id=$id";
    $result = $conn->query($sql);

    while($row = $result->fetch_array()) {
        $address=$row["address"];
        $phone=$row["phone"];
        $bday=$row["bday"];
        $gender=$row["gender"];
        $role=$row["role"];
    }
    $sql = "SELECT * FROM skills where id=$id";
    $result = $conn->query($sql);

    while($row = $result->fetch_array()) {
        $skill[0]=$row["skill1"];
        $skill[1]=$row["skill2"];
        $skill[2]=$row["skill3"];
        $skill[3]=$row["skill4"];
        $skill[4]=$row["skill5"];
        $skill[5]=$row["skill6"];
    }


    $conn->close();
?>

    <div style="background-color:#ffd9b3" class="container py-4 my-2" align="center">
        <div style="background-color:#D8D8D8" class="edit ">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Phone no.</label>
                <input type="number" name="ph" value="<?php echo $phone;?>" required>
                <br>
                <br>
                <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
                <input type="text" name="address" value="<?php echo $address;?>" required>
                <br>
                <br>
                <label for="inputEmail3" class="col-sm-2 col-form-label">Birthday</label>
                <input type="date" name="bday" value="<?php echo $bday;?>" required>
                <br>
                <br>
                <label for="inputEmail3" class="col-sm-2 col-form-label">Gender</label>

                <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>
                    value="female">Female
                <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?>
                    value="male">Male
                <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?>
                    value="other">Other
                <br>
                <br>
                <label for="inputEmail3" class="col-sm-2 col-form-label">Role</label>
                <input type="text" name="role" value="<?php echo $role;?>" required>
                <br>
                <br>
        </div>
        <br>
        Skills<br>
        <div style="background-color:#D8D8D8" class="skill">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" name="skill1" value="<?php echo $skill[0];?>" required><br>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="skill2" value="<?php echo $skill[1];?>" required><br>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="skill3" value="<?php echo $skill[2];?>" required><br>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" name="skill4" value="<?php echo $skill[3];?>" required><br>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="skill5" value="<?php echo $skill[4];?>" required><br>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="skill6" value="<?php echo $skill[5];?>" required><br>
                </div>
            </div>
        </div>
        <br>
        <div class="submit">
            <input class="btn btn-outline-primary" type="submit" name="submit" value="Submit">
            </form>
        </div>
        <br>
        <br>
        <div style="background-color:#D8D8D8" class="upload-pic">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                Change profile picture
                <input type="file" name="fileToUpload" id="fileToUpload" required>
                <input type="submit" value="Upload" name="submit">
            </form>
        </div>
    </div>


</body>

</html>