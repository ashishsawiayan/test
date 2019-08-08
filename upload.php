<!DOCTYPE HTML>
<html>

<head>

</head>

<body>

    <?php
session_start();
$id= $_SESSION['id'];
//echo $a;
$imagename="";
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
/*if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}*/
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $imagename= basename( $_FILES["fileToUpload"]["name"]);

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
        //
        $sql = "SELECT id FROM images";
        $result = $conn->query($sql);

        $c=0;
        while($row = $result->fetch_array()) {
        if($row["id"]==$id)
        {
            $sql="UPDATE images set image='$imagename' where id=$id";
            $conn->query($sql);
            $c=1;
        }
        }


        //
        if($c==0)
        {
        $sql= "INSERT INTO images (id,image)
        VALUES ('$id','$imagename')";
        $conn->query($sql);
        }
        $conn->close();
        header("Location:profile.php");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

</body>

</html>