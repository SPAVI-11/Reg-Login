<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        div{
            background-color: #28282B;
        }
      body{
        background-image: url(https://media.giphy.com/media/U3qYN8S0j3bpK/giphy.gif);
        background-color: seashell;
      }
      p,h1{
        color:white;
      }
      #logo{ 
	position:fixed; 
	top:0; 
	left:0; 
}
    </style>
</head>
<center>
<h1>Login page</h1>
</center>
<br>
<body>
    <div class="container">
    <div id="logo"> 
	<img src="https://static.vecteezy.com/system/resources/thumbnails/008/124/712/small/initial-letter-p-with-a-swoosh-logo-template-modern-logotype-for-business-and-company-identity-free-vector.jpg"width="150"> 
</div>
        <?php
        if(isset($_POST["login"])){
            $email=$_POST["email"];
            $password=$_POST["password"];
            require_once "database.php";
        $sql= "SELECT * FROM users WHERE email='$email'";
        $result=mysqli_query($conn,$sql);
        $user=mysqli_fetch_array( $result,MYSQLI_ASSOC);
        if($user){
            if(password_verify($password,$user["password"])){
                session_start();
                $_SESSION["user"]="yes";
                header("Location: index.php");
                die();
            }
            else{
                echo"<div class='alert alert-danger'>Password does not match</div>";
            }
        }
        else{
            echo"<div class='alert alert-danger'>Email does not match</div>";
        }
        }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
    </form>
    <br>
    <div><p>Not registered yet? <a href="registeration.php">Register Here</a></p>
    </div>
</body>
</html>