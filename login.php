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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<body>
    <?php
session_start();
if(isset($_SESSION['id']))
{
  header("Location:profile.php");
}

if(isset($_REQUEST['c']))
{
echo"<script>alert('wrong password')</script>";

}
?>

    <div class="mt-4" align="center">
        <div style="background-color: #f2e6ff" class="login">
            <form action="submit.php" method="post">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <input type="text" name="email" value="" required>
                <br>
                <br>
                <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                <input type="password" name="pass" value="" required>
                <br>
                <br>
                <input type="submit" class="btn btn-outline-primary" name="submit" value="Login">
            </form>
        </div>
    </div>

</body>

</html>