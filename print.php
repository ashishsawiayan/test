<!DOCTYPE HTML>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <style>
    .left {
        background: #3c2a59;
        
    }

    .right {
        background: #d7d1e0;
        border-left: 1px solid black;
    }


    img {
        border-radius: 50%;

    }
    </style>

</head>

<body>


    <?php
    session_start();
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        //echo $id;
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
    } else {
        header("Location:index.php");
    }

    

    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        //echo $id;
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
    } else {
        header("Location:index.php");
    }
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM education where id=$id";
    $result = $conn->query($sql);
    $d = 0;

    while ($row = $result->fetch_array()) {
        if ($id == $row["id"]) {
            $clg=$row["college"];
            $start_c=$row["start"];
            $end_c=$row["start"];
            $degree=$row["degree"];
            $stream=$row["stream"];
            $pscale=$row["scale"];
            $perf=$row["performance"];
        } 
        //$image="";
    }
    
    //
    $sql = "SELECT * FROM projects where id=$id";
    $result = $conn->query($sql);
    if(isset($result))
    while ($row = $result->fetch_array()) {
        if ($id == $row["id"]) {
            $title = $row["title"];
            $start = $row["start_date"];
            $end = $row["end_date"];
            $des = $row["descp"];
            $link = $row["link"];
        }} 
        //$image="";
    //
    $sql = "SELECT * FROM profile where id=$id";
    $result = $conn->query($sql);

    while ($row = $result->fetch_array()) {
        $address = $row["address"];
        $phone = $row["phone"];
        $bday = $row["bday"];
        $gender = $row["gender"];
        $role = $row["role"];
        //$image="";
    }

    $sql = "SELECT * FROM skills where id=$id";
    $result = $conn->query($sql);
    while ($row = $result->fetch_array()) {
        $skill[0] = $row["skill1"];
        $skill[1] = $row["skill2"];
        $skill[2] = $row["skill3"];
        $skill[3] = $row["skill4"];
        $skill[4] = $row["skill5"];
        $skill[5] = $row["skill6"];
    }
    // echo $skill[1];

    $sql = "SELECT * FROM images where id=$id";
    $result = $conn->query($sql);
    while ($row = $result->fetch_array()) {
        $image = $row["image"];
    }

    
    ?>
    <script>window.print();</script>

    <div class="container">
        <div class="row">
            <div class="col-md-3 left ">
                <div class="text-center mt-4 md-4">
                    <img src="<?php echo "./uploads/" . $image; ?>" alt="Avatar" style="width:200px">
                </div>
                <br>
                <div class="text-center mt-4">
                    <i class="material-icons outlined">room</i>
                    <br>
                    <h3 class="h6 text-uppercase ">
                        <font color="white">address</font>
                    </h3>
                    <font color="#9fede8"><?php echo $address?></font>


                </div>
                <br>
                <div class="text-center mt-4">
                    <i class="material-icons">info</i>
                    <br>
                    <h3 class="h6 text-uppercase"><font color="white">about me</font></h3>
                    <font color="#9fede8"> Highly accurate data entry clerk with 5 years of experience, seeking position with Media Level
                    Marketing. 10-Key Typing Speed of 15,000 KPH with zero errors.Maintained 99% accuracy in two
                    fast-paced data entry positions, entering 750-1000 records per day.</font>
                </div>

                <br>
                <div class="text-center mt-4">
                    <i class="material-icons outlined">explore</i>
                    <br>
                    <h3 class="h6 text-uppercase ">
                        <font color="white">skills</font>
                    </h3>
                    <div class="text-upperclass">
                    <font  color="#9fede8"><?php foreach ($skill as $value) {
                        echo "$value <br>";
                    }?></font>
                    </div>

                </div>

            </div>
            <div class="col-md-9 right">
                <br>
                <br>
                <div class="text-center mt-4 md-4">
                    <h3 class="h1 text-uppercase ">
                        <?php echo $name; ?>
                    </h3>
                </div>
                <div class="row">
                    <div class="col-md-4 text-center"><?php echo $email; ?></div>
                    <div class="col-md-4 text-center"><?php echo $phone; ?></div>
                    <div class="col-md-4 text-center"><?php echo $role; ?></div>




                </div>
                <hr>
                <br>
                <div class="row">
                    
                    <div class="col-md-4 text-right">

                        <h3 class="h6 text-uppercase ">
                            <font color="white">Education</font>
                        </h3>
                    </div>
                    <div class="col-md-4">
                        <b><?php echo $clg; ?><br></b>
                        <?php echo date('M-Y', strtotime($start_c)); ?>
                        to
                        <?php echo date('M-Y', strtotime($end_c)); ?>
                        <br>
                        <?php echo $degree; ?>,<?php echo $stream; ?>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-4 text-right">
                        <h3 class="h6 text-uppercase ">
                            <font color="white">Recent Project</font>
                        </h3>
                    </div>
                    <div class="col-md-6">
                        <b><?php echo $title; ?></b>
                        <br>
                        <?php echo date('d-M-Y', strtotime($start_c)); ?>
                        to
                        <?php echo date('d-M-Y', strtotime($end_c)); ?>
                        <br>
                        <?php echo $des; ?>
                    </div>
                </div>
                <br>
                <br>

                <div class="row">
                    <div class="col-md-4 text-right">
                        <h3 class="h6 text-uppercase ">
                            <font color="white">Hobbies</font>
                        </h3>
                    </div>
                    <div class="col-md-4">
                    <?php  
                                   $sql = "SELECT * FROM hobbies where id=$id";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_array()) {
                                        echo $row["hobby1"]."<br>";
                                        
                                        echo $row["hobby2"]."<br>";
                                        echo $row["hobby3"]."<br>";
                                        echo $row["hobby4"]."<br>";
                                    }?>
                    </div>
                </div>


            </div>
        </div>



    </div>


</body>

</html>