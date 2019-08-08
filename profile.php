<!DOCTYPE HTML>
<html>

<head type="text/css" media="print">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <style>
    .print {
        visibility: visible;
    }

    .chart {
        position: relative;
        text-align: center;
    }

    .chart canvas {
        display: block;
        margin: 0px auto;
    }

    .chart span {
        position: absolute;
        width: 100%;
        text-align: center;
        left: 0;
        top: 50%;
        margin-top: -12px;
        color: #999;
    }

    .choose_file {
        position: relative;
        display: inline-block;
        border-radius: 8px;
        border: #ebebeb solid 1px;
        width: 250px;
        padding: 4px 6px 4px 8px;
        font: normal 14px Myriad Pro, Verdana, Geneva, sans-serif;
        color: #7f7f7f;
        margin-top: 2px;
        background: white
    }

    .choose_file input[type="file"] {
        -webkit-appearance: none;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .login {
        margin: auto;
        width: 50%;
        border: 3px solid #73AD21;
        padding: 10px;
    }

    .buttons_container {
        margin: auto;
        width: 50%;

    }

    .profile-pic {
        margin: auto;
        width: 20%;
        border: 3px solid #73AD21;
        padding: 10px;
        box-shadow: 10px 10px 5px grey;
    }

    .about {
        border-radius: 0px 20px 20px 20px;
        ;
        border: 1px solid #73AD21;
        padding: 10px;
        box-shadow: 5px 5px 2px grey;

    }

    .skill {
        border-radius: 20px;
        border: 1px solid #73AD21;
        padding: 10px;
        box-shadow: 10px 10px 5px grey;

    }

    .left {
        border-radius: 20px;
        border: 1px solid #73AD21;
        padding: 10px;

    }

    .right {
        border-radius: 20px;
        border: 1px solid #73AD21;
        padding: 10px;
        background-image: url("./image/lightgn.jpg");

    }

    .back {
        background-image: url("./image/bg.jpg");
    }
    </style>
</head>

<body>
    <script>
    window.onpopstate = function() {
        header("Location:index.php");
    };
    history.pushState({}, '');
    </script>
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
    $sql = "SELECT id FROM profile";
    $result = $conn->query($sql);

    $c = 0;
    while ($row = $result->fetch_array()) {
        if ($id == $row["id"]) {
            $c = 1;
        }
    }


    if ($c == 0) {
        $sql = "INSERT INTO profile (id,phone,address,gender,about)
    VALUES ('$id','0','--','--','--')";
        $conn->query($sql);
        //$conn->close();
    }

    $sql = "SELECT id FROM hobbies";
    $result = $conn->query($sql);

    $h = 0;
    while ($row = $result->fetch_array()) {
        if ($id == $row["id"]) {
            $h = 1;
        }
    }


    if ($h == 0) {
        $sql = "INSERT INTO hobbies
    VALUES ('$id','--','--','--','--')";
        $conn->query($sql);
        //$conn->close();
    }


    $sql = "SELECT * FROM skills";
    $result = $conn->query($sql);

    $c = 0;
    while ($row = $result->fetch_array()) {
        if ($id == $row["id"]) {
            $c = 1;
        }
    }


    if ($c == 0) {
        $sql = "INSERT INTO skills
    VALUES ('$id','--','--','--','--','--','--')";
        $conn->query($sql);
        //$conn->close();
    }


    $sql = "SELECT * FROM education where id=$id";
    $result = $conn->query($sql);
    $d = 0;

    $clg="college";
    $start_c="start date";
    $end_c="end date";
    $degree="degree";
    $stream="stream";
    $pscale="10";
    $perf="10";
    //$title = "Title";
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
    $title = "Title";
    $start = "";
    $end = "";
    $des = "description";
    $link = "project link";
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
        $about=$row["about"];
    }

    $skill = array("", "", "", "", "", "");
    $i = 0;
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

    $hobby = array("", "", "", "", "");

    $sql = "SELECT * FROM hobbies where id=$id";
    $result = $conn->query($sql);
    while ($row = $result->fetch_array()) {
        $hobby[0] = $row["hobby1"];
        $hobby[1] = $row["hobby1"];
        $hobby[2] = $row["hobby1"];
        $hobby[3] = $row["hobby1"];
        
    }
    // echo $skill[1];

    $sql = "SELECT * FROM images where id=$id";
    $result = $conn->query($sql);
    while ($row = $result->fetch_array()) {
        $image = $row["image"];
    }

    ?>

    <div style="background-color:white" class="rounded  container py-4 my-2">
        <div class="row">
            <div style="background-color:#ffe0cc" class=" back left col-md-4 pr-md-5">
                <img class="profile-pic w-100  rounded border" src="<?php echo "./uploads/" . $image; ?>"
                    alt="upload picture" />


                <br>
                <br>

                <div style="background-color:#04923C" class=" skill pt-4 mt-2">
                    <section class="mb-5 mb-md-0">
                        <h3 class="h6 text-uppercase ml-4">Skills</h3>
                        <br>
                        <div class="skills pt-1 row">

                            <div class="col-4 mb-4">
                                <div class="chart text-uppercase" data-percent="95" data-scale-color="#fff">
                                    <span><?php echo $skill[0]; ?></span></div>
                            </div>
                            <div class="col-4 mb-4">
                                <div class="chart text-uppercase" data-percent="85" data-scale-color="#fff">
                                    <span><?php echo $skill[1]; ?></span></div>
                            </div>
                            <div class="col-4 mb-4">
                                <div class="chart text-uppercase" data-percent="90" data-scale-color="#fff">
                                    <span><?php echo $skill[2]; ?></span></div>
                            </div>
                            <div class="col-4 mb-4">
                                <div class="chart text-uppercase" data-percent="82" data-scale-color="#fff">
                                    <span><?php echo $skill[3]; ?></span></div>
                            </div>
                            <div class="col-4 mb-4">
                                <div class="chart text-uppercase" data-percent="70" data-scale-color="#fff">
                                    <span><?php echo $skill[4]; ?></span></div>
                            </div>
                            <div class="col-4 mb-4">
                                <div class="chart text-uppercase" data-percent="60" data-scale-color="#fff">
                                    <span><?php echo $skill[5]; ?></span></div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
            <div style="background-color:#c6ffad" class="right col-md-8">
                <div class="d-flex align-items-center mt-4 mr-4">
                    <h2 class="font-weight-bold m-0">
                        <?php echo $name; ?>
                    </h2>
                    <form action="logout.php" method="post">
                        <button type="submit" class="btn btn-outline-danger ml-4">Logout</button>
                    </form>
                </div>
                <p class="h5 text-primary mt-2 d-block font-weight-light">
                    <?php echo $role; ?>
                </p>

                <p>
                    Highly accurate data entry clerk with 5 years of experience, seeking position with Media Level
                    Marketing. 10-Key Typing Speed of 15,000 KPH with zero errors.Maintained 99% accuracy in
                    two fast-paced data entry positions, entering 750-1000 records per day.
                </p>

                <section class="mt-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">
                                About
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#project" role="tab"
                                aria-controls="contact" aria-selected="false">
                                Recent Project
                            </a>
                        </li>
                        <!--education tab-->
                        <li class="nav-item">
                            <a class="nav-link" id="education-tab" data-toggle="tab" href="#education" role="tab"
                                aria-controls="contact" aria-selected="false">
                                Education
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="hobbies-tab" data-toggle="tab" href="#hobbies" role="tab"
                                aria-controls="contact" aria-selected="false">
                                Hobbies
                            </a>
                        </li>

                    </ul>
                    <div style="background-color:lightblue  " class=" about tab-content py-4 mb-4" id="myTabContent">
                        <div class="tab-pane py-3 fade show active ml-4" id="home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <h6 class="text-uppercase font-weight-light text-secondary">
                                Contact Information
                            </h6>
                            <dl class="row mt-4 mb-4 pb-3">
                                <dt class="col-sm-3">Phone</dt>
                                <dd class="col-sm-9"><?php echo $phone; ?></dd>

                                <dt class="col-sm-3">Home address</dt>
                                <dd class="col-sm-9">
                                    <address class="mb-0">
                                        <?php echo $address; ?>
                                    </address>
                                </dd>

                                <dt class="col-sm-3">Email address</dt>
                                <dd class="col-sm-9">
                                    <a href="mailto:ashishsawaiyan7@gmail.com"><?php echo $email; ?></a>
                                </dd>
                            </dl>

                            <h6 class="text-uppercase font-weight-light text-secondary">
                                Basic Information
                            </h6>
                            <dl class="row mt-4 mb-4 pb-3">
                                <dt class="col-sm-3">Birthday</dt>
                                <dd class="col-sm-9"><?php echo $bday; ?></dd>

                                <dt class="col-sm-3">Gender</dt>
                                <dd class="col-sm-9"><?php echo $gender; ?></dd>
                            </dl>

                            <div align="center">
                                <form action="edit.php">
                                    <button class="btn btn-outline-success" type="submit" name="edit"
                                        value="edit">EDIT</button>
                                </form>
                                <!--button type="submit" name="print" value="print" onclick="window.print();return false;" >print</button-->
                            </div>
                        </div>

                        <div class="tab-pane fade" id="project" role="tabpanel" aria-labelledby="contact-tab">

                            <div class="prefilled-other-experiences-details-left-cell detail-left-element">
                                <h5><?php echo $title; ?></h5>
                                <div><?php echo date('d-M-Y', strtotime($start)); ?> to
                                    <?php echo date('d-M-Y', strtotime($end)); ?></div>
                                <br>
                                <div class="description"><?php echo $des; ?></div>
                                <br>
                                <div><a href="#" target="_blank"
                                        rel="nofollow noopener noreferrer"><?php echo $link; ?></a></div>
                            </div>

                            <br>




                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModalCenter">
                                Update
                            </button>

                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Add Projects</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!---->
                                            <div class="panel-body">
                                                <form action="project.php" method="POST">
                                                    <div class="form-group">
                                                        <label for="title" class="control-label">Title*:</label>
                                                        <div class="input-group">
                                                            <input type="hidden" name="type" value="project">
                                                            <input type="hidden" name="id" id="project_id"
                                                                value="project">

                                                            <input type="text" class="form-control"
                                                                id="other_experiences_title" tabindex="1" name="title"
                                                                placeholder="Ex: Optical Character Recognition "
                                                                aria-required="true" value="<?php echo $title?>"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="col-xs-6 left_container">
                                                                <label for="other_experiences_project_start_date"
                                                                    class="control-label">Start Month*:</label>
                                                                <div>
                                                                    <input type="date"
                                                                        class="form-control start-date hasDatepicker"
                                                                        name="start_date" id="start_date_to_send"
                                                                        value="<?php echo $start?>" aria-required="true"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 right_container">
                                                                <label for="other_experiences_project_end_date"
                                                                    class="control-label">End Month*:</label>
                                                                <div>
                                                                    <input type="date"
                                                                        class="form-control start-date hasDatepicker"
                                                                        name="end_date" id="end_date_to_send"
                                                                        value="<?php echo $end?>" aria-required="true"
                                                                        required>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="other_experiences_project_description"
                                                            class="control-label">Description:</label>
                                                        <div class="input-group">
                                                            <textarea type="text" rows="4" class="form-control valid"
                                                                tabindex="6"
                                                                placeholder="Short description about project (Max 250 char)"
                                                                name="description" aria-invalid="false"
                                                                required> <?php echo $des?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="other_experiences_project_link"
                                                            class="control-label">Project Link:</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control"
                                                                id="other_experiences_project_link" tabindex="7"
                                                                name="project_link" value="<?php echo $link?>"
                                                                placeholder="Ex: http://myprojectlink.com ">
                                                        </div>
                                                    </div>
                                                    <div class="buttons_container">
                                                        <input class="btn pull-right btn-primary " id="project-submit"
                                                            tabindex="8" type="submit" name="submit" value="Save">
                                                    </div>
                                                </form>
                                            </div>
                                            <!---->
                                        </div>
                                        <!--div-- class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </!--div-->
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--education tab-->
                        <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">
                            <div>
                                <h5><?php echo$degree?>, <?php echo$stream?>
                                    (<?php echo date('M-Y', strtotime($start_c)); ?> to
                                    <?php echo date('M-Y', strtotime($end_c)); ?>)
                                </h5>
                                <div><?php echo $clg?></div>
                                <div>CGPA : <?php echo$perf?>/<?php echo$pscale?></div>
                            </div>
                            <br>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModalCenter2">

                                Update
                            </button>
                            <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenter2Title">Graduation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="panel-body">
                                                <form action="education.php" id="college-form" method="POST">
                                                    <div class="form-group row ml-4">
                                                        <div class="col-xs-12 start-year">
                                                            <label for="degree_completion_status" class="control-label"
                                                                id="degree_completion_status_label">Graduation
                                                                status*:</label>
                                                        </div>
                                                        <div class="col-xs-6 start-year"
                                                            id="degree_completion_status_pursuing_container">
                                                            <div class="degree_completion_status_container_pursuing">
                                                                <input type="radio"
                                                                    id="degree_completion_status_pursuing"
                                                                    name="degree_completion_status" value="pursuing"
                                                                    aria-required="true"> Pursuing
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 end-year"
                                                            id="degree_completion_status_completed_container">
                                                            <div class="degree_completion_status_container_completed">
                                                                <input type="radio"
                                                                    id="degree_completion_status_completed"
                                                                    name="degree_completion_status" value="completed">
                                                                Completed
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ml-4">
                                                        <label for="college" class="control-label">College*:</label>
                                                        <div class="input-group">
                                                            <input type="text" id="college" tabindex="1"
                                                                class="form-control " autocomplete="off"
                                                                isautocomplete="" name="college"
                                                                placeholder="Ex: Hindu College " required
                                                                value="<?php echo $clg?>" aria-required="true">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row ml-4">
                                                        <div class="col-xs-6  ">
                                                            <label for="start_year" class="control-label">Start
                                                                Year*:</label>
                                                            <div>
                                                                <input type="date"
                                                                    class="form-control start-date hasDatepicker"
                                                                    name="start_date" id="start_date_to_send"
                                                                    value="<?php echo $start_c?>" aria-required="true"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 ml-4">
                                                            <label for="end_year" class="control-label"
                                                                id="degree_end_year">End Year*:</label>
                                                            <div>
                                                                <input type="date"
                                                                    class="form-control start-date hasDatepicker"
                                                                    name="end_date" id="end_date"
                                                                    value="<?php echo $end_c?>" aria-required="true"
                                                                    required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ml-4">
                                                        <div id="degree_container" class="form-group">
                                                            <label for="degree" class="control-label">Degree*:</label>
                                                            <div class="input-group">
                                                                <input type="text" id="degree" tabindex="4"
                                                                    class="form-control ui-autocomplete-input"
                                                                    autocomplete="off" isautocomplete="" name="degree"
                                                                    placeholder="Ex: B.Sc (Hons.) " required
                                                                    value="<?php echo $degree?>" aria-required="true">
                                                            </div>
                                                        </div>
                                                        <div id="college_stream_container" class="form-group">
                                                            <label for="stream" class="control-label"
                                                                id="stream_label">Stream:</label>
                                                            <div class="input-group">
                                                                <input type="text" id="stream" tabindex="5"
                                                                    class="form-control ui-autocomplete-input"
                                                                    autocomplete="off" isautocomplete="" name="stream"
                                                                    value="<?php echo $stream?>"
                                                                    placeholder="Ex: Economics " required>
                                                            </div>
                                                        </div>
                                                        <div class="tips_education">
                                                            <ul>
                                                                <li>Example: If your degree is B.Sc in Chemistry, then
                                                                    select Bachelor of Science (B.Sc) in <b>degree</b>
                                                                    and Chemistry in <b>streams</b>.</li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row ml-4">
                                                        <div class="col-xs-6 performance-scale_container">
                                                            <div>
                                                                <label for="performance_scale"
                                                                    class="control-label">Performance Scale:</label>
                                                                <select class="form-control"
                                                                    id="performance-scale-college" tabindex="6"
                                                                    name="performance_scale">
                                                                    <option value="100">Percentage</option>
                                                                    <option value="10" selected="">CGPA (Scale of 10)
                                                                    </option>
                                                                    <option value="7">CGPA (Scale of 7)</option>
                                                                    <option value="5">CGPA (Scale of 5)</option>
                                                                    <option value="4">CGPA (Scale of 4)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 performance ml-4">
                                                            <label for="performance"
                                                                class="control-label">Performance:</label>
                                                            <div>
                                                                <input type="number" class="form-control"
                                                                    id="performance-college" tabindex="7"
                                                                    value="<?php echo $perf?>" name="performance"
                                                                    placeholder="0.00" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="buttons_container">
                                                        <input name="submit" class="btn btn-primary pull-right ml-4"
                                                            id="college-submit" value="Save" type="submit">
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <div class="tab-pane fade" id="hobbies" role="tabpanel" aria-labelledby="education-tab">
                            <div class="prefilled-education-details-left-cell detail-left-element">


                                <?php  
                                   $sql = "SELECT * FROM hobbies where id=$id";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_array()) {
                                        echo $row["hobby1"]."<br>";
                                        
                                        echo $row["hobby2"]."<br>";
                                        echo $row["hobby3"]."<br>";
                                        echo $row["hobby4"]."<br>";
                                    }?>
                                    <br>

                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenter3">
                                    Update
                                </button>

                                <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Add Hobby</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!---->
                                                <div class="panel-body">
                                                    <form action="hobbies.php" method="POST">

                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="col-xs-6 ml-3 left_container">
                                                                    <div>
                                                                        <input type="text" class="form-control"
                                                                            name="hobby1" value="<?php echo $hobby[0]?>"
                                                                            aria-required="true" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 ml-4 right_container">
                                                                    <div>
                                                                        <input type="text" class="form-control"
                                                                            name="hobby2" value="<?php echo $hobby[1]?>"
                                                                            aria-required="true" required>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="col-xs-6 ml-3 left_container">
                                                                    <div>
                                                                        <input type="text" name="hobby3"
                                                                            class="form-control"
                                                                            value="<?php echo $hobby[2]?>"
                                                                            aria-required="true" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 ml-4 right_container">
                                                                    <div>
                                                                        <input type="text" class="form-control"
                                                                            name="hobby4" value="<?php echo $hobby[3]?>"
                                                                            aria-required="true" required>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        

                                                        <div class="buttons_container">
                                                            <input class="btn pull-right btn-primary "
                                                                id="project-submit" tabindex="8" type="submit"
                                                                name="submit" value="Save">
                                                        </div>
                                                    </form>
                                                </div>
                                                <!---->
                                            </div>
                                            <!--div-- class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </!--div-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->
                    </div>
                    <div align="center">
                        <form action="print.php">
                            <button class="btn btn-outline-success" type="submit" name="edit"
                                value="edit">PRINT</button>
                        </form>
                        <!--button type="submit" name="print" value="print" onclick="window.print();return false;" >print</button-->
                    </div>

            </div>

            </section>
        </div>
    </div>



    </div>




</body>

</html>